<?php
/**
 * Import Products and Strains from CSV
 * Run this via: wp eval-file import-products.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/wp-load.php');
    require_once ABSPATH;
}

echo "Starting product and strain import...\n\n";

// Import Strains first
$strains_file = __DIR__ . '/Strains-Export-2025-October-28-1515.csv';
if (!file_exists($strains_file)) {
    die("Error: Strains CSV file not found!\n");
}

echo "Importing strains...\n";
$handle = fopen($strains_file, 'r');
$header = fgetcsv($handle);

$strain_count = 0;
while (($data = fgetcsv($handle)) !== FALSE) {
    $row = array_combine($header, $data);
    
    // Skip if no title
    if (empty($row['Title'])) continue;
    
    // Check if strain exists
    $existing = get_page_by_title($row['Title'], OBJECT, 'strain');
    
    $post_data = array(
        'post_title' => $row['Title'],
        'post_content' => $row['Content'],
        'post_excerpt' => $row['Excerpt'],
        'post_status' => 'publish',
        'post_type' => 'strain',
        'post_author' => 1
    );
    
    if ($existing) {
        $post_data['ID'] = $existing->ID;
        $strain_id = wp_update_post($post_data);
        echo "Updated strain: {$row['Title']}\n";
    } else {
        $strain_id = wp_insert_post($post_data);
        echo "Created strain: {$row['Title']}\n";
    }
    
    if (!$strain_id || is_wp_error($strain_id)) {
        echo "Error creating strain: {$row['Title']}\n";
        continue;
    }
    
    // Add ACF fields
    update_field('genetics', $row['genetics'], $strain_id);
    update_field('strain_lineage', $row['genetics'], $strain_id);
    update_field('breeder', $row['breeder'], $strain_id);
    update_field('breeder_source_url', $row['breeder_source_url'], $strain_id);
    update_field('flowering_time', $row['flowering_time'], $strain_id);
    update_field('aroma_profile', $row['aroma_profile'], $strain_id);
    update_field('flavor_profile', $row['flavor_profile'], $strain_id);
    update_field('terpene_profile_json', $row['terpene_profile_json'], $strain_id);
    update_field('meta_title', $row['meta_title'], $strain_id);
    update_field('meta_description', $row['meta_description'], $strain_id);
    
    // Set strain type taxonomy
    if (!empty($row['Strain Types'])) {
        wp_set_object_terms($strain_id, $row['Strain Types'], 'strain_type');
    }
    
    // Set effects taxonomy
    if (!empty($row['Effects'])) {
        $effects = explode(',', $row['Effects']);
        $effect_ids = array();
        foreach ($effects as $effect) {
            $effect = trim($effect);
            if (!empty($effect)) {
                $term = get_term_by('name', $effect, 'effects');
                if (!$term) {
                    $term_result = wp_insert_term($effect, 'effects');
                    if (!is_wp_error($term_result)) {
                        $effect_ids[] = $term_result['term_id'];
                    }
                } else {
                    $effect_ids[] = $term->term_id;
                }
            }
        }
        if (!empty($effect_ids)) {
            wp_set_object_terms($strain_id, $effect_ids, 'effects');
        }
    }
    
    // Set terpenes taxonomy
    if (!empty($row['Terpenes'])) {
        $terpenes = explode(',', $row['Terpenes']);
        $terpene_ids = array();
        foreach ($terpenes as $terpene) {
            $terpene = trim($terpene);
            if (!empty($terpene)) {
                $term = get_term_by('name', $terpene, 'terpenes');
                if (!$term) {
                    $term_result = wp_insert_term($terpene, 'terpenes');
                    if (!is_wp_error($term_result)) {
                        $terpene_ids[] = $term_result['term_id'];
                    }
                } else {
                    $terpene_ids[] = $term->term_id;
                }
            }
        }
        if (!empty($terpene_ids)) {
            wp_set_object_terms($strain_id, $terpene_ids, 'terpenes');
        }
    }
    
    $strain_count++;
}

fclose($handle);
echo "\nImported {$strain_count} strains.\n\n";

// Now import products
$products_file = __DIR__ . '/Cannabis-Products-Export-2025-October-28-1515.csv';
if (!file_exists($products_file)) {
    die("Error: Products CSV file not found!\n");
}

echo "Importing products...\n";
$handle = fopen($products_file, 'r');
$header = fgetcsv($handle);

$product_count = 0;
while (($data = fgetcsv($handle)) !== FALSE) {
    $row = array_combine($header, $data);
    
    // Skip if no title
    if (empty($row['Title'])) continue;
    
    // Check if product exists
    $existing = get_page_by_title($row['Title'], OBJECT, 'cannabis_product');
    
    $post_data = array(
        'post_title' => $row['Title'],
        'post_content' => $row['Content'],
        'post_excerpt' => $row['Excerpt'],
        'post_status' => 'publish',
        'post_type' => 'cannabis_product',
        'post_author' => 1
    );
    
    if ($existing) {
        $post_data['ID'] = $existing->ID;
        $product_id = wp_update_post($post_data);
        echo "Updated product: {$row['Title']}\n";
    } else {
        $product_id = wp_insert_post($post_data);
        echo "Created product: {$row['Title']}\n";
    }
    
    if (!$product_id || is_wp_error($product_id)) {
        echo "Error creating product: {$row['Title']}\n";
        continue;
    }
    
    // Add ACF fields
    update_field('batch_number', $row['batch_number'], $product_id);
    update_field('strain_name', $row['strain_name'], $product_id);
    update_field('lineage', $row['lineage'], $product_id);
    update_field('product_type', $row['product_type'], $product_id);
    update_field('package_sizes', $row['package_sizes'], $product_id);
    update_field('thc_percent', $row['thc_percent'], $product_id);
    update_field('cbd_percent', $row['cbd_percent'], $product_id);
    update_field('cbg_percent', $row['cbg_percent'], $product_id);
    update_field('thcv_percent', $row['thcv_percent'], $product_id);
    update_field('terp_total_percent', $row['terp_total'], $product_id);
    update_field('terp1_name', $row['terp1_name'], $product_id);
    update_field('terp1_percent', $row['terp1_percent'], $product_id);
    update_field('terp2_name', $row['terp2_name'], $product_id);
    update_field('terp2_percent', $row['terp2_percent'], $product_id);
    update_field('terp3_name', $row['terp3_name'], $product_id);
    update_field('terp3_percent', $row['terp3_percent'], $product_id);
    update_field('lab_name', $row['lab_name'], $product_id);
    
    // Set categories taxonomy
    if (!empty($row['Cannabis Product Categories'])) {
        wp_set_object_terms($product_id, $row['Cannabis Product Categories'], 'cannabis_product_category');
    }
    
    // Set strain type based on product data
    if (!empty($row['strain_type']) && $row['strain_type'] !== 'Unknown') {
        wp_set_object_terms($product_id, $row['strain_type'], 'strain_type');
    }
    
    // Link to strain if exists
    if (!empty($row['strain_name'])) {
        $linked_strain = get_page_by_title($row['strain_name'], OBJECT, 'strain');
        if ($linked_strain) {
            update_field('product_strain', $linked_strain->ID, $product_id);
        }
    }
    
    $product_count++;
}

fclose($handle);
echo "\nImported {$product_count} products.\n\n";
echo "Import complete!\n";

