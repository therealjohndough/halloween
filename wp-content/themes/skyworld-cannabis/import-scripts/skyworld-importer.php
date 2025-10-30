<?php
/**
 * Skyworld Cannabis Data Importer
 * Imports strains and products from CSV files
 * 
 * Usage: Place CSV files in wp-content/uploads/skyworld-import/
 * Run via WP-CLI: wp eval-file import-scripts/skyworld-importer.php
 */

if (!defined('ABSPATH')) {
    echo "This script must be run within WordPress.\n";
    exit;
}

class SkyworldImporter {
    
    private $upload_dir;
    private $import_dir;
    private $strain_map = [];
    
    public function __construct() {
        $upload_dir = wp_upload_dir();
        $this->upload_dir = $upload_dir['basedir'];
        $this->import_dir = $this->upload_dir . '/skyworld-import/';
        
        if (!file_exists($this->import_dir)) {
            wp_mkdir_p($this->import_dir);
        }
    }
    
    /**
     * Main import function
     */
    public function import() {
        echo "Starting Skyworld Cannabis Import...\n";
        
        // Import strains first (they're the hubs)
        $this->import_strains();
        
        // Import products (they connect to strain hubs)
        $this->import_products();
        
        echo "Import complete!\n";
    }
    
    /**
     * Import strains from CSV
     */
    private function import_strains() {
        $strain_file = $this->import_dir . 'strains.csv';
        
        if (!file_exists($strain_file)) {
            echo "Strains CSV not found at: $strain_file\n";
            return;
        }
        
        echo "Importing strains...\n";
        
        $handle = fopen($strain_file, 'r');
        $header = fgetcsv($handle); // Skip header row
        
        $strain_count = 0;
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            $strain_data = array_combine($header, $data);
            
            // Create strain post
            $post_data = [
                'post_title' => sanitize_text_field($strain_data['Title']),
                'post_content' => wp_kses_post($strain_data['Content']),
                'post_excerpt' => sanitize_text_field($strain_data['Excerpt']),
                'post_type' => 'strain',
                'post_status' => 'publish',
                'post_name' => sanitize_title($strain_data['Slug'])
            ];
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                echo "Error creating strain: " . $post_id->get_error_message() . "\n";
                continue;
            }
            
            // Store strain mapping for products
            $this->strain_map[sanitize_text_field($strain_data['Title'])] = $post_id;
            
            // Add ACF fields
            $this->add_strain_meta($post_id, $strain_data);
            
            $strain_count++;
            echo "Imported strain: " . $strain_data['Title'] . " (ID: $post_id)\n";
        }
        
        fclose($handle);
        echo "Imported $strain_count strains.\n\n";
    }
    
    /**
     * Import products from CSV
     */
    private function import_products() {
        $product_file = $this->import_dir . 'products.csv';
        
        if (!file_exists($product_file)) {
            echo "Products CSV not found at: $product_file\n";
            return;
        }
        
        echo "Importing products...\n";
        
        $handle = fopen($product_file, 'r');
        $header = fgetcsv($handle);
        
        $product_count = 0;
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            $product_data = array_combine($header, $data);
            
            // Create product post
            $post_data = [
                'post_title' => sanitize_text_field($product_data['Title']),
                'post_content' => wp_kses_post($product_data['Content']),
                'post_excerpt' => sanitize_text_field($product_data['Excerpt']),
                'post_type' => 'cannabis_product',
                'post_status' => 'publish',
                'post_name' => sanitize_title($product_data['Slug'])
            ];
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                echo "Error creating product: " . $post_id->get_error_message() . "\n";
                continue;
            }
            
            // Add ACF fields and relationships
            $this->add_product_meta($post_id, $product_data);
            
            $product_count++;
            echo "Imported product: " . $product_data['Title'] . " (ID: $post_id)\n";
        }
        
        fclose($handle);
        echo "Imported $product_count products.\n\n";
    }
    
    /**
     * Add strain metadata
     */
    private function add_strain_meta($post_id, $data) {
        // Basic strain info
        update_field('genetics', sanitize_text_field($data['genetics'] ?? ''), $post_id);
        update_field('breeder', sanitize_text_field($data['breeder'] ?? ''), $post_id);
        update_field('breeder_source_url', esc_url($data['breeder_source_url'] ?? ''), $post_id);
        update_field('flowering_time', sanitize_text_field($data['flowering_time'] ?? ''), $post_id);
        update_field('aroma_profile', sanitize_text_field($data['aroma_profile'] ?? ''), $post_id);
        update_field('flavor_profile', sanitize_text_field($data['flavor_profile'] ?? ''), $post_id);
        
        // SEO fields
        update_field('meta_title', sanitize_text_field($data['meta_title'] ?? ''), $post_id);
        update_field('meta_description', sanitize_text_field($data['meta_description'] ?? ''), $post_id);
        
        // Parse terpene JSON if available
        if (!empty($data['terpene_profile_json'])) {
            $terpenes = json_decode($data['terpene_profile_json'], true);
            if ($terpenes && is_array($terpenes)) {
                update_field('terpene_profile', $terpenes, $post_id);
            }
        }
        
        // Set strain type taxonomy
        if (!empty($data['Strain Types'])) {
            wp_set_post_terms($post_id, [sanitize_text_field($data['Strain Types'])], 'strain_type');
        }
    }
    
    /**
     * Add product metadata and relationships
     */
    private function add_product_meta($post_id, $data) {
        // Basic product info
        update_field('batch_number', sanitize_text_field($data['batch_number'] ?? ''), $post_id);
        update_field('strain_name', sanitize_text_field($data['strain_name'] ?? ''), $post_id);
        update_field('lineage', sanitize_text_field($data['lineage'] ?? ''), $post_id);
        update_field('package_sizes', sanitize_text_field($data['package_sizes'] ?? ''), $post_id);
        update_field('lab_name', sanitize_text_field($data['lab_name'] ?? ''), $post_id);
        
        // Cannabinoid percentages
        update_field('thc_percent', floatval($data['thc_percent'] ?? 0), $post_id);
        update_field('cbd_percent', floatval($data['cbd_percent'] ?? 0), $post_id);
        update_field('cbg_percent', floatval($data['cbg_percent'] ?? 0), $post_id);
        update_field('thcv_percent', floatval($data['thcv_percent'] ?? 0), $post_id);
        update_field('terp_total', floatval($data['terp_total'] ?? 0), $post_id);
        
        // Top 3 terpenes
        if (!empty($data['terp1_name'])) {
            update_field('terp1_name', sanitize_text_field($data['terp1_name']), $post_id);
            update_field('terp1_percent', floatval($data['terp1_percent'] ?? 0), $post_id);
        }
        if (!empty($data['terp2_name'])) {
            update_field('terp2_name', sanitize_text_field($data['terp2_name']), $post_id);
            update_field('terp2_percent', floatval($data['terp2_percent'] ?? 0), $post_id);
        }
        if (!empty($data['terp3_name'])) {
            update_field('terp3_name', sanitize_text_field($data['terp3_name']), $post_id);
            update_field('terp3_percent', floatval($data['terp3_percent'] ?? 0), $post_id);
        }
        
        // Set taxonomies
        if (!empty($data['strain_type'])) {
            wp_set_post_terms($post_id, [sanitize_text_field($data['strain_type'])], 'strain_type');
        }
        if (!empty($data['product_type'])) {
            wp_set_post_terms($post_id, [sanitize_text_field($data['product_type'])], 'product_type');
        }
        
        // Create strain relationship (hub-and-spoke)
        $strain_name = sanitize_text_field($data['strain_name'] ?? '');
        if ($strain_name && isset($this->strain_map[$strain_name])) {
            $strain_id = $this->strain_map[$strain_name];
            update_field('related_strain', $strain_id, $post_id);
            
            // Add this product to the strain's related products
            $strain_products = get_field('related_products', $strain_id) ?: [];
            $strain_products[] = $post_id;
            update_field('related_products', $strain_products, $strain_id);
        }
    }
}

// Run the importer
$importer = new SkyworldImporter();

if (defined('WP_CLI') && WP_CLI) {
    $importer->import();
} else {
    // Manual execution check
    if (current_user_can('manage_options')) {
        $importer->import();
    } else {
        echo "You need administrator privileges to run this importer.\n";
    }
}