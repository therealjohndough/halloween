<?php
/**
 * Skyworld Cannabis - Standalone CPT Registration & Import System
 * 
 * This file can be used on any WordPress site with ACF Pro installed.
 * It registers Custom Post Types (Strains & Products) and their ACF fields.
 * 
 * Usage:
 * 1. Upload this file to your WordPress site
 * 2. Run via WP-CLI: wp eval-file skyworld-cpt-system.php
 * 3. Or include in functions.php: include_once 'path/to/skyworld-cpt-system.php';
 * 
 * Requirements:
 * - WordPress 5.0+
 * - ACF Pro plugin installed and activated
 * 
 * @version 1.0.0
 * @author Skyworld Cannabis
 */

// Prevent direct access
if (!defined('WPINC') && !defined('WP_CLI')) {
    die('Direct access not allowed. Run via WP-CLI or include in WordPress.');
}

class SkyWorldCPTSystem {
    
    private $version = '1.0.0';
    private $plugin_name = 'Skyworld CPT System';
    
    public function __construct() {
        $this->init();
    }
    
    /**
     * Initialize the CPT system
     */
    public function init() {
        // Check if ACF Pro is available
        if (!function_exists('acf_add_local_field_group')) {
            $this->log_error('ACF Pro is required but not found. Please install and activate ACF Pro.');
            return false;
        }
        
        $this->log_message("🚀 Initializing {$this->plugin_name} v{$this->version}");
        
        // Register hooks
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('acf/init', array($this, 'register_acf_fields'));
        
        // If running via CLI, execute immediately
        if (defined('WP_CLI') && WP_CLI) {
            $this->register_post_types();
            $this->register_taxonomies();
            $this->register_acf_fields();
            $this->flush_rewrite_rules();
            $this->display_status();
        }
        
        return true;
    }
    
    /**
     * Register Custom Post Types
     */
    public function register_post_types() {
        $this->log_message("📝 Registering Custom Post Types...");
        
        // Strains CPT
        $strains_args = array(
            'labels' => array(
                'name' => 'Strains',
                'singular_name' => 'Strain',
                'add_new' => 'Add New Strain',
                'add_new_item' => 'Add New Strain',
                'edit_item' => 'Edit Strain',
                'new_item' => 'New Strain',
                'view_item' => 'View Strain',
                'view_items' => 'View Strains',
                'search_items' => 'Search Strains',
                'not_found' => 'No strains found',
                'not_found_in_trash' => 'No strains found in trash',
                'all_items' => 'All Strains',
                'archives' => 'Strain Archives',
                'attributes' => 'Strain Attributes',
                'insert_into_item' => 'Insert into strain',
                'uploaded_to_this_item' => 'Uploaded to this strain',
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'rewrite' => array(
                'slug' => 'strains',
                'with_front' => false,
                'pages' => true,
                'feeds' => true,
            ),
            'menu_icon' => 'dashicons-carrot',
            'menu_position' => 20,
            'can_export' => true,
            'delete_with_user' => false,
        );
        
        register_post_type('strains', $strains_args);
        $this->log_message("  ✅ Strains CPT registered");
        
        // Products CPT  
        $products_args = array(
            'labels' => array(
                'name' => 'Products',
                'singular_name' => 'Product',
                'add_new' => 'Add New Product',
                'add_new_item' => 'Add New Product',
                'edit_item' => 'Edit Product',
                'new_item' => 'New Product',
                'view_item' => 'View Product',
                'view_items' => 'View Products',
                'search_items' => 'Search Products',
                'not_found' => 'No products found',
                'not_found_in_trash' => 'No products found in trash',
                'all_items' => 'All Products',
                'archives' => 'Product Archives',
                'attributes' => 'Product Attributes',
                'insert_into_item' => 'Insert into product',
                'uploaded_to_this_item' => 'Uploaded to this product',
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'rewrite' => array(
                'slug' => 'products',
                'with_front' => false,
                'pages' => true,
                'feeds' => true,
            ),
            'menu_icon' => 'dashicons-products',
            'menu_position' => 21,
            'can_export' => true,
            'delete_with_user' => false,
        );
        
        register_post_type('products', $products_args);
        $this->log_message("  ✅ Products CPT registered");
    }
    
    /**
     * Register Custom Taxonomies
     */
    public function register_taxonomies() {
        $this->log_message("🏷️  Registering Taxonomies...");
        
        // Strain Types (Indica/Sativa/Hybrid)
        register_taxonomy('strain_type', 'strains', array(
            'labels' => array(
                'name' => 'Strain Types',
                'singular_name' => 'Strain Type',
                'search_items' => 'Search Strain Types',
                'all_items' => 'All Strain Types',
                'edit_item' => 'Edit Strain Type',
                'update_item' => 'Update Strain Type',
                'add_new_item' => 'Add New Strain Type',
                'new_item_name' => 'New Strain Type Name',
                'menu_name' => 'Strain Types',
            ),
            'hierarchical' => true,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'strain-type'),
        ));
        $this->log_message("  ✅ Strain Types taxonomy registered");
        
        // Product Types (Flower, Pre-roll, Hash Hole)
        register_taxonomy('product_type', 'products', array(
            'labels' => array(
                'name' => 'Product Types',
                'singular_name' => 'Product Type',
                'search_items' => 'Search Product Types',
                'all_items' => 'All Product Types',
                'edit_item' => 'Edit Product Type',
                'update_item' => 'Update Product Type',
                'add_new_item' => 'Add New Product Type',
                'new_item_name' => 'New Product Type Name',
                'menu_name' => 'Product Types',
            ),
            'hierarchical' => true,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'product-type'),
        ));
        $this->log_message("  ✅ Product Types taxonomy registered");
        
        // Effects (shared between strains and products)
        register_taxonomy('effects', array('strains', 'products'), array(
            'labels' => array(
                'name' => 'Effects',
                'singular_name' => 'Effect',
                'search_items' => 'Search Effects',
                'all_items' => 'All Effects',
                'edit_item' => 'Edit Effect',
                'update_item' => 'Update Effect',
                'add_new_item' => 'Add New Effect',
                'new_item_name' => 'New Effect Name',
                'menu_name' => 'Effects',
            ),
            'hierarchical' => false,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'effects'),
        ));
        $this->log_message("  ✅ Effects taxonomy registered");
    }
    
    /**
     * Register ACF Field Groups
     */
    public function register_acf_fields() {
        $this->log_message("🔧 Registering ACF Field Groups...");
        
        // Strains ACF Fields
        acf_add_local_field_group(array(
            'key' => 'group_strains_fields',
            'title' => 'Strain Information',
            'fields' => array(
                array(
                    'key' => 'field_strain_genetics',
                    'label' => 'Genetics/Lineage', 
                    'name' => 'strain_genetics',
                    'type' => 'text',
                    'instructions' => 'Parent strains (e.g., "Ice Cream Cake x Sherb BX1")',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_strain_description',
                    'label' => 'Strain Description',
                    'name' => 'strain_description',
                    'type' => 'textarea',
                    'instructions' => 'Detailed description of the strain',
                    'required' => 0,
                    'rows' => 4,
                ),
                array(
                    'key' => 'field_thc_percent',
                    'label' => 'THC Percentage',
                    'name' => 'thc_percent',
                    'type' => 'number',
                    'instructions' => 'THC percentage (e.g., 25.9)',
                    'required' => 0,
                    'min' => 0,
                    'max' => 100,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_cbd_percent',
                    'label' => 'CBD Percentage',
                    'name' => 'cbd_percent',
                    'type' => 'number',
                    'instructions' => 'CBD percentage (e.g., 0.5)',
                    'required' => 0,
                    'min' => 0,
                    'max' => 100,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_terpene_profile',
                    'label' => 'Terpene Profile',
                    'name' => 'terpene_profile',
                    'type' => 'textarea',
                    'instructions' => 'Terpene breakdown (e.g., "Myrcene 0.74; Linalool 0.52")',
                    'required' => 0,
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_aroma_flavor',
                    'label' => 'Aroma & Flavor',
                    'name' => 'aroma_flavor',
                    'type' => 'textarea',
                    'instructions' => 'Aroma and flavor profile description',
                    'required' => 0,
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_cultivation_notes',
                    'label' => 'Cultivation Notes',
                    'name' => 'cultivation_notes',
                    'type' => 'textarea',
                    'instructions' => 'Indoor cultivation details and growing notes',
                    'required' => 0,
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_strain_gallery',
                    'label' => 'Strain Gallery',
                    'name' => 'strain_gallery',
                    'type' => 'gallery',
                    'instructions' => 'High-resolution strain photos',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_coa_file',
                    'label' => 'Certificate of Analysis (COA)',
                    'name' => 'coa_file',
                    'type' => 'file',
                    'instructions' => 'Upload COA PDF file',
                    'required' => 0,
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'pdf',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'strains',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
        $this->log_message("  ✅ Strains ACF fields registered");
        
        // Products ACF Fields
        acf_add_local_field_group(array(
            'key' => 'group_products_fields',
            'title' => 'Product Information',
            'fields' => array(
                array(
                    'key' => 'field_related_strain',
                    'label' => 'Related Strain',
                    'name' => 'related_strain',
                    'type' => 'post_object',
                    'instructions' => 'Select the strain this product is made from',
                    'required' => 0,
                    'post_type' => array('strains'),
                    'taxonomy' => '',
                    'allow_null' => 1,
                    'multiple' => 0,
                    'return_format' => 'object',
                ),
                array(
                    'key' => 'field_batch_number',
                    'label' => 'Batch Number',
                    'name' => 'batch_number',
                    'type' => 'text',
                    'instructions' => 'Batch identifier (e.g., SW051925-HH-SPXPR)',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_product_weight',
                    'label' => 'Product Weight/Size',
                    'name' => 'product_weight',
                    'type' => 'text',
                    'instructions' => 'Weight or size (e.g., "3.5g", "0.5g 2pk")',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_product_description',
                    'label' => 'Product Description',
                    'name' => 'product_description',
                    'type' => 'textarea',
                    'instructions' => 'Product-specific description',
                    'required' => 0,
                    'rows' => 4,
                ),
                array(
                    'key' => 'field_product_thc',
                    'label' => 'Product THC %',
                    'name' => 'product_thc',
                    'type' => 'number',
                    'instructions' => 'THC percentage specific to this batch',
                    'required' => 0,
                    'min' => 0,
                    'max' => 100,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_product_cbd',
                    'label' => 'Product CBD %',
                    'name' => 'product_cbd',
                    'type' => 'number',
                    'instructions' => 'CBD percentage specific to this batch',
                    'required' => 0,
                    'min' => 0,
                    'max' => 100,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_product_gallery',
                    'label' => 'Product Gallery',
                    'name' => 'product_gallery',
                    'type' => 'gallery',
                    'instructions' => 'Product photos',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_product_coa',
                    'label' => 'Product COA',
                    'name' => 'product_coa',
                    'type' => 'file',
                    'instructions' => 'Batch-specific Certificate of Analysis',
                    'required' => 0,
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'pdf',
                ),
                array(
                    'key' => 'field_availability_notes',
                    'label' => 'Availability Notes',
                    'name' => 'availability_notes',
                    'type' => 'textarea',
                    'instructions' => 'Store availability or special notes',
                    'required' => 0,
                    'rows' => 2,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'products',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
        $this->log_message("  ✅ Products ACF fields registered");
    }
    
    /**
     * Create default taxonomies terms
     */
    public function create_default_terms() {
        $this->log_message("🏷️  Creating default taxonomy terms...");
        
        // Strain Types
        $strain_types = array('Indica', 'Sativa', 'Hybrid');
        foreach ($strain_types as $type) {
            if (!term_exists($type, 'strain_type')) {
                wp_insert_term($type, 'strain_type');
                $this->log_message("  ✅ Created strain type: $type");
            }
        }
        
        // Product Types
        $product_types = array('Flower', 'Pre-roll', 'Hash Hole');
        foreach ($product_types as $type) {
            if (!term_exists($type, 'product_type')) {
                wp_insert_term($type, 'product_type');
                $this->log_message("  ✅ Created product type: $type");
            }
        }
        
        // Common Effects
        $effects = array(
            'Relaxed', 'Happy', 'Euphoric', 'Uplifted', 'Creative', 
            'Focused', 'Energetic', 'Sleepy', 'Hungry', 'Giggly'
        );
        foreach ($effects as $effect) {
            if (!term_exists($effect, 'effects')) {
                wp_insert_term($effect, 'effects');
                $this->log_message("  ✅ Created effect: $effect");
            }
        }
    }
    
    /**
     * Flush rewrite rules
     */
    public function flush_rewrite_rules() {
        $this->log_message("🔄 Flushing rewrite rules...");
        flush_rewrite_rules(false);
        $this->log_message("  ✅ Rewrite rules flushed");
    }
    
    /**
     * Display system status
     */
    public function display_status() {
        $this->log_message("\n📊 System Status:");
        
        // Check CPTs
        $post_types = get_post_types(array('public' => true), 'names');
        
        if (in_array('strains', $post_types)) {
            $strains_count = wp_count_posts('strains');
            $this->log_message("  ✅ Strains CPT: {$strains_count->publish} published, {$strains_count->draft} draft");
        } else {
            $this->log_message("  ❌ Strains CPT not found");
        }
        
        if (in_array('products', $post_types)) {
            $products_count = wp_count_posts('products');
            $this->log_message("  ✅ Products CPT: {$products_count->publish} published, {$products_count->draft} draft");
        } else {
            $this->log_message("  ❌ Products CPT not found");
        }
        
        // Check taxonomies
        $taxonomies = get_taxonomies(array('public' => true), 'names');
        
        $required_taxonomies = array('strain_type', 'product_type', 'effects');
        foreach ($required_taxonomies as $taxonomy) {
            if (in_array($taxonomy, $taxonomies)) {
                $terms_count = wp_count_terms(array('taxonomy' => $taxonomy));
                $this->log_message("  ✅ {$taxonomy}: {$terms_count} terms");
            } else {
                $this->log_message("  ❌ {$taxonomy} not found");
            }
        }
        
        $this->log_message("\n🎉 Skyworld CPT System ready!");
        $this->log_message("👉 Check WordPress Admin > Strains and Products");
    }
    
    /**
     * Install everything at once
     */
    public function install() {
        $this->log_message("🚀 Installing Skyworld CPT System...");
        
        if (!$this->init()) {
            return false;
        }
        
        $this->create_default_terms();
        $this->flush_rewrite_rules();
        $this->display_status();
        
        return true;
    }
    
    /**
     * Log messages
     */
    private function log_message($message) {
        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::log($message);
        } else {
            echo $message . "\n";
        }
    }
    
    /**
     * Log errors
     */
    private function log_error($message) {
        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::error($message);
        } else {
            echo "ERROR: " . $message . "\n";
        }
    }
}

// Auto-execute if running via WP-CLI or direct inclusion
if (defined('WP_CLI') && WP_CLI) {
    $skyworld_cpt = new SkyWorldCPTSystem();
    $skyworld_cpt->install();
} elseif (defined('WPINC')) {
    // Just initialize if included in WordPress (don't auto-install)
    new SkyWorldCPTSystem();
}

?>