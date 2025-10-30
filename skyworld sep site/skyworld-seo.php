<?php
/**
 * Skyworld SEO (no paid plugin)
 * - Titles, meta description, canonical
 * - Open Graph / Twitter
 * - JSON-LD for: Product (sw-product), ProductModel (sw-strain), ItemList (archives), Organization (front page)
 * - BreadcrumbList JSON-LD
 * - Robots: noindex on search, 404, filtered archives; index otherwise
 * - Sitemaps: ensures CPTs/taxonomies in core WP sitemaps
 *
 * Drop into your child theme and require_once from functions.php,
 * or activate as a small plugin (add headers).
 */

if (!defined('ABSPATH')) exit;

add_action('after_setup_theme', function() {
    add_theme_support('title-tag'); // Astra already does, but safe.
});

/** ------------ Helpers ------------ */
function skyworld_get_seo_title() {
    // Prefer ACF per-post title if set
    if (function_exists('get_field')) {
        $custom = get_field('seo_title');
        if ($custom) return wp_strip_all_tags($custom);
    }
    // Fallback: WP core title
    return wp_get_document_title();
}

function skyworld_trim($text, $len = 160) {
    $text = wp_strip_all_tags($text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    if (mb_strlen($text) <= $len) return $text;
    return mb_substr($text, 0, $len - 1) . '…';
}

function skyworld_get_seo_description() {
    if (function_exists('get_field')) {
        $custom = get_field('seo_description');
        if ($custom) return skyworld_trim($custom, 160);
    }
    if (is_singular()) {
        global $post;
        if (has_excerpt($post)) return skyworld_trim(get_the_excerpt($post), 160);
        return skyworld_trim(wp_strip_all_tags(get_the_content(null, false, $post)), 160);
    } elseif (is_category() || is_tax()) {
        $term = get_queried_object();
        if (!empty($term->description)) return skyworld_trim($term->description, 160);
    } elseif (is_home() || is_front_page()) {
        return skyworld_trim(get_bloginfo('description'), 160);
    }
    return '';
}

function skyworld_site_logo_url() {
    if (function_exists('the_custom_logo')) {
        $id = get_theme_mod('custom_logo');
        if ($id) {
            $img = wp_get_attachment_image_src($id, 'full');
            if (!empty($img[0])) return esc_url($img[0]);
        }
    }
    return '';
}

function skyworld_primary_image_url() {
    if (is_singular() && has_post_thumbnail()) {
        $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if (!empty($src[0])) return esc_url($src[0]);
    }
    // Fallback: site logo if any
    $logo = skyworld_site_logo_url();
    if ($logo) return $logo;
    return '';
}

function skyworld_is_filtered_archive() {
    if (!(is_post_type_archive('sw-product') || is_post_type_archive('sw-strain') || is_tax())) return false;
    $allowed = ['paged'];
    foreach ($_GET as $k => $v) {
        if (!in_array($k, $allowed, true) && $v !== '') return true;
    }
    return false;
}

/** ------------ Head Meta ------------ */
add_action('wp_head', function() {
    // Robots
    if (is_search() || is_404() || skyworld_is_filtered_archive()) {
        echo "<meta name=\"robots\" content=\"noindex,follow\">\n";
    } else {
        echo "<meta name=\"robots\" content=\"index,follow\">\n";
    }

    // Canonical
    $canon = '';
    if (is_singular()) {
        $canon = get_permalink();
    } elseif (is_tax()) {
        $canon = get_term_link(get_queried_object());
    } elseif (is_post_type_archive()) {
        $canon = get_post_type_archive_link(get_query_var('post_type'));
    } elseif (is_home() || is_front_page()) {
        $canon = home_url('/');
    }
    if (!is_wp_error($canon) && $canon) {
        // Keep canonical stable on pagination (self-referencing canonicals per page)
        if (get_query_var('paged')) {
            $paged = (int) get_query_var('paged');
            $canon = trailingslashit($canon) . 'page/' . $paged . '/';
        }
        echo '<link rel="canonical" href="' . esc_url($canon) . '">' . "\n";
    }

    // Meta title/description
    $title = skyworld_get_seo_title();
    $desc  = skyworld_get_seo_description();
    if ($desc) {
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    }

    // Open Graph / Twitter
    $url  = (is_singular() || is_tax() || is_post_type_archive() || is_home() || is_front_page()) ? $canon : home_url('/');
    $img  = skyworld_primary_image_url();
    $type = (is_singular('sw-product') ? 'product' : (is_singular() ? 'article' : 'website'));
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    if ($desc) echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    if ($img) echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    if ($desc) echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
    if ($img) echo '<meta name="twitter:image" content="' . esc_url($img) . '">' . "\n";

    // JSON-LD
    echo skyworld_jsonld();
}, 5);

/** ------------ JSON-LD builders ------------ */
function skyworld_jsonld() {
    $graph = [];

    if (is_front_page()) {
        $org = [
            "@type" => "Organization",
            "@id"   => home_url('#organization'),
            "name"  => get_bloginfo('name'),
            "url"   => home_url('/'),
        ];
        $logo = skyworld_site_logo_url();
        if ($logo) $org["logo"] = ["@type"=>"ImageObject","url"=>$logo];
        $graph[] = $org;
        // WebSite entity for Sitelinks Search Box eligibility
        $graph[] = [
            "@type" => "WebSite",
            "@id" => home_url('#website'),
            "url" => home_url('/'),
            "name" => get_bloginfo('name'),
            "potentialAction" => [{
                "@type": "SearchAction",
                "target": home_url('/?s={search_term_string}'),
                "query-input": "required name=search_term_string"
            }]
        ];
    }

    if (is_singular('sw-strain')) {
        $post_id = get_the_ID();
        $name    = get_the_title();
        $img     = skyworld_primary_image_url();
        $props   = skyworld_property_values_for_strain($post_id);
        $graph[] = array_filter([
            "@type" => "ProductModel",
            "@id"   => get_permalink($post_id) . '#productmodel',
            "name"  => $name,
            "url"   => get_permalink($post_id),
            "image" => $img ?: null,
            "category" => "Cannabis Strain",
            "additionalProperty" => $props ?: null,
        ]);
    }

    if (is_singular('sw-product')) {
        $post_id = get_the_ID();
        $name    = get_the_title();
        $img     = skyworld_primary_image_url();
        $batch   = get_post_meta($post_id, 'batch_number', true);
        $strain  = get_post_meta($post_id, 'related_strain', true);
        $ptype   = wp_get_post_terms($post_id, 'product-type', ['fields'=>'names']);
        $weight  = wp_get_post_terms($post_id, 'weight', ['fields'=>'names']);

        $model = null;
        if ($strain) {
            $model = [
                "@type" => "ProductModel",
                "name"  => get_the_title($strain),
                "url"   => get_permalink($strain),
            ];
        }
        $props = skyworld_property_values_for_product($post_id);
        if (!empty($weight)) {
            $props[] = ["@type"=>"PropertyValue","name"=>"Package Weight","value"=>implode(', ', $weight)];
        }
        if (!empty($ptype)) {
            $props[] = ["@type"=>"PropertyValue","name"=>"Product Type","value"=>implode(', ', $ptype)];
        }

        $graph[] = array_filter([
            "@type" => "Product",
            "@id"   => get_permalink($post_id) . '#product',
            "name"  => $name,
            "url"   => get_permalink($post_id),
            "image" => $img ?: null,
            "sku"   => $batch ?: null,
            "isVariantOf" => $model ?: null,
            "additionalProperty" => $props ?: null,
            "brand" => [
                "@type" => "Brand",
                "name"  => get_bloginfo('name')
            ],
        ]);
    }

    if (is_post_type_archive(['sw-product','sw-strain']) || is_tax()) {
        global $wp_query;
        $items = [];
        foreach ($wp_query->posts as $i => $p) {
            $items[] = [
                "@type" => "ListItem",
                "position" => $i + 1,
                "url" => get_permalink($p)
            ];
        }
        $graph[] = [
            "@type" => "ItemList",
            "itemListElement" => $items
        ];
    }

    // BreadcrumbList
    $crumbs = skyworld_breadcrumbs();
    if ($crumbs) $graph[] = $crumbs;

    if (empty($graph)) return '';
    $data = [
        "@context" => "https://schema.org",
        "@graph"   => array_values(array_filter($graph))
    ];
    return '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

function skyworld_property_values_for_strain($post_id) {
    $map = [
        'Lineage' => get_post_meta($post_id, 'lineage', true),
        'THC %'   => get_post_meta($post_id, 'thc_percent', true),
        'CBD %'   => get_post_meta($post_id, 'cbd_percent', true),
        'CBG %'   => get_post_meta($post_id, 'cbg_percent', true),
        'Total Cannabinoids %' => get_post_meta($post_id, 'total_cannabinoids_percent', true),
        'Total Terpenes %'     => get_post_meta($post_id, 'total_terpenes_percent', true),
    ];
    $props = [];
    foreach ($map as $k=>$v) {
        if ($v !== '' && $v !== null) {
            $props[] = ["@type"=>"PropertyValue","name"=>$k,"value"=>$v];
        }
    }
    // Dominant terpenes (taxonomy)
    $terps = wp_get_post_terms($post_id, 'terpene', ['fields'=>'names']);
    if (!empty($terps)) {
        $props[] = ["@type"=>"PropertyValue","name"=>"Dominant Terpenes","value"=>implode(', ', $terps)];
    }
    return $props;
}

function skyworld_property_values_for_product($post_id) {
    $map = [
        'THC %'   => get_post_meta($post_id, 'thc_percent', true),
        'CBD %'   => get_post_meta($post_id, 'cbd_percent', true),
        'Package Size' => get_post_meta($post_id, 'package_size', true),
        'Availability' => get_post_meta($post_id, 'availability', true),
        'Batch Number' => get_post_meta($post_id, 'batch_number', true),
    ];
    $props = [];
    foreach ($map as $k=>$v) {
        if ($v !== '' && $v !== null) {
            $props[] = ["@type"=>"PropertyValue","name"=>$k,"value"=>$v];
        }
    }
    return $props;
}

/** ------------ Breadcrumbs (JSON-LD only) ------------ */
function skyworld_breadcrumbs() {
    $items = [];
    $pos = 1;
    $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>"Home","item"=>home_url('/')];

    if (is_singular('sw-strain')) {
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>"Strains","item"=>get_post_type_archive_link('sw-strain')];
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>get_the_title(),"item"=>get_permalink()];
    } elseif (is_singular('sw-product')) {
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>"Products","item"=>get_post_type_archive_link('sw-product')];
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>get_the_title(),"item"=>get_permalink()];
    } elseif (is_post_type_archive('sw-strain')) {
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>"Strains","item"=>get_post_type_archive_link('sw-strain')];
    } elseif (is_post_type_archive('sw-product')) {
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>"Products","item"=>get_post_type_archive_link('sw-product')];
    } elseif (is_tax()) {
        $term = get_queried_object();
        $items[] = ["@type"=>"ListItem","position"=>$pos++,"name"=>$term->name,"item"=>get_term_link($term)];
    } else {
        return null;
    }
    return ["@type"=>"BreadcrumbList","itemListElement"=>$items];
}

/** ------------ Sitemaps: include CPTs & taxonomies ------------ */
add_filter('wp_sitemaps_post_types', function($post_types) {
    $post_types['sw-product'] = 'sw-product';
    $post_types['sw-strain']  = 'sw-strain';
    return $post_types;
});
add_filter('wp_sitemaps_taxonomies', function($taxes) {
    foreach (['strain-type','product-type','weight','terpene','cannabinoid','effects','aroma-flavor-profile'] as $t) {
        $taxes[$t] = $t;
    }
    return $taxes;
});

/** ------------ Performance niceties ------------ */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

