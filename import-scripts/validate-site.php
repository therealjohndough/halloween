<?php
/**
 * Skyworld Cannabis - Site Validation & Testing Script
 * Validates all functionality: templates, data, SEO, performance
 * Run with: wp eval-file import-scripts/validate-site.php
 */

echo "🧪 SKYWORLD CANNABIS SITE VALIDATION\n";
echo "=====================================\n\n";

$validation_results = [
    'templates' => [],
    'data' => [],
    'seo' => [],
    'performance' => [],
    'compliance' => []
];

// Template Validation
echo "📄 Template Validation\n";
echo "-----------------------\n";

$required_templates = [
    'single-products.php' => 'Product pages',
    'archive-products.php' => 'Product listings',
    'single-strains.php' => 'Strain pages',
    'archive-strains.php' => 'Strain listings',
    'front-page.php' => 'Homepage',
    'header.php' => 'Site header',
    'footer.php' => 'Site footer'
];

foreach ($required_templates as $template => $description) {
    $template_path = get_template_directory() . '/' . $template;
    if (file_exists($template_path)) {
        echo "   ✅ {$description} ({$template})\n";
        $validation_results['templates'][$template] = true;
    } else {
        echo "   ❌ Missing: {$description} ({$template})\n";
        $validation_results['templates'][$template] = false;
    }
}

// Data Validation
echo "\n📊 Data Validation\n";
echo "-------------------\n";

// Check post types
$strain_count = wp_count_posts('strains')->publish ?? 0;
$product_count = wp_count_posts('products')->publish ?? 0;

echo "   📍 Strains: {$strain_count} published\n";
echo "   📦 Products: {$product_count} published\n";

$validation_results['data']['strains'] = $strain_count > 0;
$validation_results['data']['products'] = $product_count > 0;

// Check authentic strains
$authentic_strains = [
    'Stay Puft', 'Garlic Gravity', 'Sherb Cream Pie', 'Skyworld Wafflez'
];

$found_authentic = 0;
foreach ($authentic_strains as $strain_name) {
    $strain = get_page_by_title($strain_name, OBJECT, 'strains');
    if ($strain) {
        $found_authentic++;
    }
}

echo "   🌿 Authentic strains found: {$found_authentic}/" . count($authentic_strains) . "\n";
$validation_results['data']['authentic_strains'] = $found_authentic > 0;

// Check hub-spoke relationships
$sample_product = get_posts(['post_type' => 'products', 'numberposts' => 1]);
if ($sample_product) {
    $related_strain = get_field('related_strain', $sample_product[0]->ID);
    $has_relationships = !empty($related_strain);
    echo "   🔗 Hub-spoke relationships: " . ($has_relationships ? "✅ Working" : "❌ Missing") . "\n";
    $validation_results['data']['relationships'] = $has_relationships;
}

// SEO Validation
echo "\n🔍 SEO Validation\n";
echo "------------------\n";

// Check if SEO functions are loaded
$seo_functions = [
    'skyworld_add_structured_data',
    'skyworld_organization_schema',
    'skyworld_enhanced_meta_tags'
];

$seo_loaded = 0;
foreach ($seo_functions as $function) {
    if (function_exists($function)) {
        $seo_loaded++;
    }
}

echo "   📋 SEO functions loaded: {$seo_loaded}/" . count($seo_functions) . "\n";
$validation_results['seo']['functions'] = $seo_loaded === count($seo_functions);

// Check structured data on front page
ob_start();
if (function_exists('skyworld_organization_schema')) {
    skyworld_organization_schema();
}
$schema_output = ob_get_clean();

$has_schema = !empty($schema_output) && strpos($schema_output, '@context') !== false;
echo "   🏢 Organization schema: " . ($has_schema ? "✅ Present" : "❌ Missing") . "\n";
$validation_results['seo']['schema'] = $has_schema;

// Performance Validation
echo "\n⚡ Performance Validation\n";
echo "-------------------------\n";

// Check CSS/JS files
$css_file = get_template_directory() . '/assets/css/main.css';
$js_file = get_template_directory() . '/assets/js/main.js';

$css_exists = file_exists($css_file);
$js_exists = file_exists($js_file);

echo "   🎨 Main CSS file: " . ($css_exists ? "✅ Present" : "❌ Missing") . "\n";
echo "   ⚙️ Main JS file: " . ($js_exists ? "✅ Present" : "❌ Missing") . "\n";

$validation_results['performance']['assets'] = $css_exists && $js_exists;

// Check for font files
$font_dir = get_template_directory() . '/assets/fonts/';
$has_fonts = is_dir($font_dir) && count(glob($font_dir . '*.ttf')) > 0;

echo "   🔤 SkyFont files: " . ($has_fonts ? "✅ Present" : "❌ Missing") . "\n";
$validation_results['performance']['fonts'] = $has_fonts;

// Compliance Validation
echo "\n🛡️ NY Cannabis Compliance\n";
echo "--------------------------\n";

// Check for age gate integration point
$header_content = file_get_contents(get_template_directory() . '/header.php');
$has_age_gate = strpos($header_content, 'age-gate-container') !== false;

echo "   🔞 Age gate integration: " . ($has_age_gate ? "✅ Ready" : "❌ Missing") . "\n";
$validation_results['compliance']['age_gate'] = $has_age_gate;

// Check for NY license display
$license_present = strpos($header_content, 'OCM-') !== false || 
                   strpos(file_get_contents(get_template_directory() . '/footer.php'), 'OCM-') !== false;

echo "   📜 NY License display: " . ($license_present ? "✅ Present" : "⚠️ Review needed") . "\n";
$validation_results['compliance']['license'] = $license_present;

// Menu Validation
echo "\n🍔 Navigation Validation\n";
echo "------------------------\n";

$menu_exists = wp_get_nav_menu_object('Primary Menu');
$has_menu = !empty($menu_exists);

echo "   📍 Primary menu: " . ($has_menu ? "✅ Created" : "❌ Missing") . "\n";

// Check hamburger menu functionality
$has_hamburger = strpos($header_content, 'hamburger-toggle') !== false;
echo "   🍔 Hamburger menu: " . ($has_hamburger ? "✅ Present" : "❌ Missing") . "\n";

$validation_results['templates']['navigation'] = $has_menu && $has_hamburger;

// Overall Score Calculation
echo "\n📊 VALIDATION SUMMARY\n";
echo "=====================\n";

$total_checks = 0;
$passed_checks = 0;

foreach ($validation_results as $category => $checks) {
    $category_passed = 0;
    $category_total = count($checks);
    
    foreach ($checks as $check => $result) {
        $total_checks++;
        if ($result) {
            $passed_checks++;
            $category_passed++;
        }
    }
    
    $category_score = $category_total > 0 ? round(($category_passed / $category_total) * 100) : 0;
    echo "   " . ucfirst($category) . ": {$category_passed}/{$category_total} ({$category_score}%)\n";
}

$overall_score = $total_checks > 0 ? round(($passed_checks / $total_checks) * 100) : 0;

echo "\n🎯 OVERALL SCORE: {$passed_checks}/{$total_checks} ({$overall_score}%)\n";

if ($overall_score >= 90) {
    echo "🏆 EXCELLENT! Site is ready for deployment.\n";
} elseif ($overall_score >= 75) {
    echo "👍 GOOD! Minor issues to address before deployment.\n";
} elseif ($overall_score >= 60) {
    echo "⚠️ NEEDS WORK! Several issues require attention.\n";
} else {
    echo "❌ CRITICAL ISSUES! Major problems must be fixed.\n";
}

// Deployment Checklist
if ($overall_score >= 75) {
    echo "\n✅ DEPLOYMENT CHECKLIST\n";
    echo "=======================\n";
    echo "   1. Upload theme files to live server\n";
    echo "   2. Run import script: wp eval-file import-scripts/complete-site-import.php\n";
    echo "   3. Configure age gate plugin\n";
    echo "   4. Set up store locator plugin\n";
    echo "   5. Add product/strain images\n";
    echo "   6. Test mobile navigation\n";
    echo "   7. Verify hero slider animations\n";
    echo "   8. Check COA file accessibility\n";
    echo "   9. Test contact forms\n";
    echo "   10. Monitor Core Web Vitals\n";
}

echo "\n🚀 Validation complete!\n";

// Return results for programmatic use
return $validation_results;
?>