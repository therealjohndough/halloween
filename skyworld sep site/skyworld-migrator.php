<?php
/**
 * Plugin Name: Skyworld Woo → Hub&Spoke Migrator
 * Description: Converts existing WooCommerce 'product' posts into sw-strain (hub) + sw-product (spoke) with relationships.
 * Version: 1.0.0
 * Author: Skyworld
 */
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function() {
    add_management_page('Skyworld Migrator', 'Skyworld Migrator', 'manage_options', 'skyworld-migrator', 'skyworld_migrator_admin');
});

function skyworld_migrator_admin() {
    if (!current_user_can('manage_options')) return;
    echo '<div class="wrap"><h1>Skyworld Migrator</h1>';
    if (isset($_POST['do_migrate'])) {
        check_admin_referer('skyworld_migrate');
        $report = skyworld_run_migration();
        echo '<pre style="white-space:pre-wrap;background:#111;color:#0f0;padding:16px;border-radius:6px;max-height:480px;overflow:auto;">' . esc_html($report) . '</pre>';
    } else {
        echo '<p>This will scan WooCommerce products and create matching sw-strain hubs (deduped) and sw-product spokes linked via ACF.</p>';
        echo '<form method="post">';
        wp_nonce_field('skyworld_migrate');
        submit_button('Run Migration');
        echo '</form>';
    }
    echo '</div>';
}

function skyworld_slugify($text) {
    $text = sanitize_title($text);
    return $text ?: 'item-' . wp_generate_password(8,false,false);
}

function skyworld_guess_strain_name($title) {
    // Remove common product tokens like weight and type from title to isolate strain
    $patterns = [
        '/\b(1g|3\.5g|3,5g|2pk\s*\.5g|2\spk\s*0?\.5g|6pk\s*\.5g|\d+pk\s*\.\d+g)\b/i',
        '/\b(flower|pre-?roll|hash\s*hole|hashhole|vape|rosin|cart|concentrate|live\s*rosin|indica|sativa|hybrid)\b/i',
        '/[-–|•]+/'
    ];
    $name = $title;
    foreach ($patterns as $p) {
        $name = preg_replace($p, '', $name);
    }
    $name = trim(preg_replace('/\s{2,}/', ' ', $name));
    return $name ?: $title;
}

function skyworld_get_or_create_strain($name, $source_post) {
    $slug = skyworld_slugify($name);
    $existing = get_page_by_path($slug, OBJECT, 'sw-strain');
    if ($existing) return $existing->ID;
    $id = wp_insert_post([
        'post_type' => 'sw-strain',
        'post_status' => 'publish',
        'post_title' => $name,
        'post_name' => $slug,
        'post_content' => '',
    ]);
    if (is_wp_error($id)) return 0;

    // Copy strain-type term if present on source product
    $strain_terms = wp_get_post_terms($source_post->ID, 'strain-type', ['fields'=>'ids']);
    if (!is_wp_error($strain_terms) && $strain_terms) {
        wp_set_object_terms($id, $strain_terms, 'strain-type', false);
    }

    // Copy dominant terpenes taxonomy if present on source (works if tax assigned to products previously)
    $terp_terms = wp_get_post_terms($source_post->ID, 'terpene', ['fields'=>'ids']);
    if (!is_wp_error($terp_terms) && $terp_terms) {
        wp_set_object_terms($id, $terp_terms, 'terpene', false);
    }

    // Lineage if available
    $lineage = get_post_meta($source_post->ID, 'lineage', true);
    if ($lineage) update_post_meta($id, 'lineage', $lineage);

    // Thumbnail: inherit source product thumbnail if present
    $thumb = get_post_thumbnail_id($source_post->ID);
    if ($thumb) set_post_thumbnail($id, $thumb);

    return $id;
}

function skyworld_run_migration() {
    $out = [];
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => ['publish','draft','pending','private','future'],
        'fields' => 'ids'
    ];
    $ids = get_posts($args);
    $out[] = 'Found ' . count($ids) . ' WooCommerce products.';
    $count_products = 0; $count_strains_new = 0; $count_strains_existing = 0;
    foreach ($ids as $pid) {
        $p = get_post($pid);
        $title = get_the_title($pid);
        $strain_name = skyworld_guess_strain_name($title);
        $strain_id_before = get_page_by_path(sanitize_title($strain_name), OBJECT, 'sw-strain');
        $strain_id = skyworld_get_or_create_strain($strain_name, $p);
        if ($strain_id) {
            if ($strain_id_before) $count_strains_existing++; else $count_strains_new++;
        }

        // Build sw-product
        $prod_title = $title; // Keep as-is
        $prod_id = wp_insert_post([
            'post_type' => 'sw-product',
            'post_status' => 'publish',
            'post_title' => $prod_title,
            'post_name' => skyworld_slugify($prod_title),
            'post_content' => '', // keep clean; design later
        ]);
        if (is_wp_error($prod_id)) { $out[] = 'Error creating product for ' . $title; continue; }

        // Relationship
        if ($strain_id) update_post_meta($prod_id, 'related_strain', $strain_id);

        // Copy/meta mapping
        $map_keys = ['thc_percent','cbd_percent','cbg_percent','total_cannabinoids_percent','total_terpenes_percent','availability','package_size'];
        // Legacy aliases seen in export
        $aliases = [
            'cannabinoids_percent' => 'total_cannabinoids_percent',
            'terp_percent' => 'total_terpenes_percent',
        ];
        foreach ($aliases as $old=>$new) {
            $val = get_post_meta($pid, $old, true);
            if ($val !== '' && $val !== null) update_post_meta($prod_id, $new, $val);
        }
        foreach ($map_keys as $k) {
            $val = get_post_meta($pid, $k, true);
            if ($val !== '' && $val !== null) update_post_meta($prod_id, $k, $val);
        }

        // Taxonomies: product-type (default Flower if category says flower), weight terms
        $ptype_ids = [];
        $legacy_cat = wp_get_post_terms($pid, 'category', ['fields'=>'slugs']);
        if (!is_wp_error($legacy_cat) && in_array('flower', $legacy_cat, true)) {
            $term = term_exists('Flower', 'product-type');
            if ($term) $ptype_ids[] = (int)$term['term_id'];
        }
        $explicit_ptype = wp_get_post_terms($pid, 'product-type', ['fields'=>'ids']);
        if (!is_wp_error($explicit_ptype) && $explicit_ptype) $ptype_ids = array_merge($ptype_ids, $explicit_ptype);
        if ($ptype_ids) wp_set_object_terms($prod_id, array_unique($ptype_ids), 'product-type', false);

        $weight_terms = wp_get_post_terms($pid, 'weight', ['fields'=>'ids']);
        if (!is_wp_error($weight_terms) && $weight_terms) {
            wp_set_object_terms($prod_id, $weight_terms, 'weight', false);
        }

        // Thumbnail
        $thumb = get_post_thumbnail_id($pid);
        if ($thumb) set_post_thumbnail($prod_id, $thumb);

        // Batch# placeholder to satisfy required field; team should update in admin
        $placeholder = 'TBD-' . $pid;
        update_post_meta($prod_id, 'batch_number', $placeholder);

        $count_products++;
        $out[] = "Migrated: {$title}  →  Strain #{$strain_id}, Product #{$prod_id} (batch={$placeholder})";
    }
    $out[] = "Done. Products created: {$count_products}. Strains created: {$count_strains_new}, found existing: {$count_strains_existing}.";
    return implode("\n", $out);
}
