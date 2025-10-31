<?php
/**
 * Skyworld Cannabis - Standalone Data Importer
 * 
 * Imports strain and product data from CSV files into WordPress CPTs
 * Requires the Skyworld CPT System to be installed first
 * 
 * Usage:
 * 1. Install CPTs first: wp eval-file skyworld-cpt-system.php
 * 2. Place CSV files in same directory as this script
 * 3. Run: wp eval-file skyworld-data-importer.php
 * 
 * Expected CSV format:
 * Strains: strain_name, genetics, description, thc_percent, cbd_percent, strain_type, terpenes, aroma_flavor
 * Products: product_name, strain_name, batch_number, product_type, weight, thc_percent, description
 * 
 * @version 1.0.0
 * @author Skyworld Cannabis
 */

// Prevent direct access
if (!defined('WPINC') && !defined('WP_CLI')) {
    die('Direct access not allowed. Run via WP-CLI.');
}

class SkyWorldDataImporter {
    
    private $imported_strains = 0;
    private $imported_products = 0;
    private $skipped_items = 0;
    private $errors = array();
    
    public function __construct() {
        $this->log_message("🌿 Skyworld Cannabis - Data Importer");
        $this->log_message("=====================================");
    }
    
    /**
     * Import data from CSV files
     */
    public function import_from_csv($strains_csv = null, $products_csv = null) {
        // Check if CPTs exist
        if (!post_type_exists('strains') || !post_type_exists('products')) {
            $this->log_error("Strains and Products CPTs not found. Please install Skyworld CPT System first.");
            return false;
        }
        
        // Check if ACF is available
        if (!function_exists('update_field')) {
            $this->log_error("ACF not found. Please install ACF Pro.");
            return false;
        }
        
        $this->log_message("✅ CPTs and ACF found. Starting import...\n");
        
        // Import strains first (products reference strains)
        if ($strains_csv && file_exists($strains_csv)) {
            $this->import_strains($strains_csv);
        } else {
            $this->log_message("⚠️  Strains CSV not found, looking for default files...");
            $this->find_and_import_strains();
        }
        
        // Import products
        if ($products_csv && file_exists($products_csv)) {
            $this->import_products($products_csv);
        } else {
            $this->log_message("⚠️  Products CSV not found, looking for default files...");
            $this->find_and_import_products();
        }
        
        $this->display_results();
        return true;
    }
    
    /**
     * Find and import strain CSV files
     */
    private function find_and_import_strains() {
        $possible_files = array(
            'strains.csv',
            'skyworld-strains.csv',
            'Strains-Export-*.csv',
            'skyworld-strains-library-import.csv'
        );
        
        foreach ($possible_files as $pattern) {
            $files = glob($pattern);
            if (!empty($files)) {
                $this->log_message("📁 Found strains file: " . $files[0]);
                $this->import_strains($files[0]);
                return;
            }
        }
        
        $this->log_message("⚠️  No strains CSV files found in current directory");
    }
    
    /**
     * Find and import products CSV files
     */
    private function find_and_import_products() {
        $possible_files = array(
            'products.csv',
            'skyworld-products.csv',
            'Cannabis-Products-Export-*.csv',
            'skyworld-product-inventory-master.csv'
        );
        
        foreach ($possible_files as $pattern) {
            $files = glob($pattern);
            if (!empty($files)) {
                $this->log_message("📁 Found products file: " . $files[0]);
                $this->import_products($files[0]);
                return;
            }
        }
        
        $this->log_message("⚠️  No products CSV files found in current directory");
    }
    
    /**
     * Import strains from CSV
     */
    private function import_strains($csv_file) {
        $this->log_message("🌱 Importing strains from: " . basename($csv_file));
        
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            $this->log_message("📋 CSV Headers: " . implode(', ', $headers));
            
            $row_count = 0;
            while (($data = fgetcsv($handle)) !== FALSE) {
                $row_count++;
                
                if (count($data) < 2) {
                    continue; // Skip empty rows
                }
                
                // Map CSV data to fields (adjust indexes based on your CSV structure)
                $strain_data = array(
                    'strain_name' => isset($data[0]) ? trim($data[0]) : '',
                    'genetics' => isset($data[1]) ? trim($data[1]) : '',
                    'description' => isset($data[2]) ? trim($data[2]) : '',
                    'thc_percent' => isset($data[3]) ? floatval($data[3]) : 0,
                    'cbd_percent' => isset($data[4]) ? floatval($data[4]) : 0,
                    'strain_type' => isset($data[5]) ? trim($data[5]) : 'Hybrid',
                    'terpenes' => isset($data[6]) ? trim($data[6]) : '',
                    'aroma_flavor' => isset($data[7]) ? trim($data[7]) : '',
                );
                
                if (empty($strain_data['strain_name'])) {
                    $this->log_message("  ⚠️  Skipping row $row_count: No strain name");
                    $this->skipped_items++;
                    continue;
                }
                
                $this->create_strain($strain_data);
            }
            
            fclose($handle);
        } else {
            $this->log_error("Could not open strains CSV file: $csv_file");
        }
    }
    
    /**
     * Import products from CSV
     */
    private function import_products($csv_file) {
        $this->log_message("📦 Importing products from: " . basename($csv_file));
        
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            $this->log_message("📋 CSV Headers: " . implode(', ', $headers));
            
            $row_count = 0;
            while (($data = fgetcsv($handle)) !== FALSE) {
                $row_count++;
                
                if (count($data) < 3) {
                    continue; // Skip empty rows
                }
                
                // Map CSV data to fields (adjust indexes based on your CSV structure)
                $product_data = array(
                    'product_name' => isset($data[0]) ? trim($data[0]) : '',
                    'strain_name' => isset($data[1]) ? trim($data[1]) : '',
                    'batch_number' => isset($data[2]) ? trim($data[2]) : '',
                    'product_type' => isset($data[3]) ? trim($data[3]) : 'Flower',
                    'weight' => isset($data[4]) ? trim($data[4]) : '',
                    'thc_percent' => isset($data[5]) ? floatval($data[5]) : 0,
                    'cbd_percent' => isset($data[6]) ? floatval($data[6]) : 0,
                    'description' => isset($data[7]) ? trim($data[7]) : '',
                );
                
                if (empty($product_data['product_name']) || empty($product_data['batch_number'])) {
                    $this->log_message("  ⚠️  Skipping row $row_count: Missing product name or batch number");
                    $this->skipped_items++;
                    continue;
                }
                
                $this->create_product($product_data);
            }
            
            fclose($handle);
        } else {
            $this->log_error("Could not open products CSV file: $csv_file");
        }
    }
    
    /**
     * Create a strain post
     */
    private function create_strain($strain_data) {
        // Check if strain already exists
        $existing = get_page_by_title($strain_data['strain_name'], OBJECT, 'strains');
        if ($existing) {
            $this->log_message("  ⚠️  Strain already exists: " . $strain_data['strain_name']);
            $this->skipped_items++;
            return false;
        }
        
        // Create the post
        $post_data = array(
            'post_title' => $strain_data['strain_name'],
            'post_content' => $strain_data['description'],
            'post_status' => 'publish',
            'post_type' => 'strains',
            'post_excerpt' => wp_trim_words($strain_data['description'], 30),
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (is_wp_error($post_id)) {
            $this->log_error("Failed to create strain: " . $strain_data['strain_name']);
            $this->errors[] = "Strain creation failed: " . $strain_data['strain_name'];
            return false;
        }
        
        // Add ACF fields
        update_field('strain_genetics', $strain_data['genetics'], $post_id);
        update_field('strain_description', $strain_data['description'], $post_id);
        update_field('thc_percent', $strain_data['thc_percent'], $post_id);
        update_field('cbd_percent', $strain_data['cbd_percent'], $post_id);
        update_field('terpene_profile', $strain_data['terpenes'], $post_id);
        update_field('aroma_flavor', $strain_data['aroma_flavor'], $post_id);
        
        // Set strain type taxonomy
        if (!empty($strain_data['strain_type'])) {
            wp_set_post_terms($post_id, $strain_data['strain_type'], 'strain_type');
        }
        
        $this->log_message("  ✅ Created strain: " . $strain_data['strain_name'] . " (ID: $post_id)");
        $this->imported_strains++;
        
        return $post_id;
    }
    
    /**
     * Create a product post
     */
    private function create_product($product_data) {
        // Check if product already exists (by batch number)
        $existing_products = get_posts(array(
            'post_type' => 'products',
            'meta_query' => array(
                array(
                    'key' => 'batch_number',
                    'value' => $product_data['batch_number'],
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        ));
        
        if (!empty($existing_products)) {
            $this->log_message("  ⚠️  Product already exists (batch: " . $product_data['batch_number'] . ")");
            $this->skipped_items++;
            return false;
        }
        
        // Find related strain
        $strain_id = null;
        if (!empty($product_data['strain_name'])) {
            $strain = get_page_by_title($product_data['strain_name'], OBJECT, 'strains');
            if ($strain) {
                $strain_id = $strain->ID;
            }
        }
        
        // Create the post
        $post_data = array(
            'post_title' => $product_data['product_name'],
            'post_content' => $product_data['description'],
            'post_status' => 'publish',
            'post_type' => 'products',
            'post_excerpt' => wp_trim_words($product_data['description'], 30),
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (is_wp_error($post_id)) {
            $this->log_error("Failed to create product: " . $product_data['product_name']);
            $this->errors[] = "Product creation failed: " . $product_data['product_name'];
            return false;
        }
        
        // Add ACF fields
        update_field('batch_number', $product_data['batch_number'], $post_id);
        update_field('product_weight', $product_data['weight'], $post_id);
        update_field('product_description', $product_data['description'], $post_id);
        update_field('product_thc', $product_data['thc_percent'], $post_id);
        update_field('product_cbd', $product_data['cbd_percent'], $post_id);
        
        // Link to strain
        if ($strain_id) {
            update_field('related_strain', $strain_id, $post_id);
        }
        
        // Set product type taxonomy
        if (!empty($product_data['product_type'])) {
            wp_set_post_terms($post_id, $product_data['product_type'], 'product_type');
        }
        
        $strain_info = $strain_id ? " → {$product_data['strain_name']}" : "";
        $this->log_message("  ✅ Created product: " . $product_data['product_name'] . " (ID: $post_id)$strain_info");
        $this->imported_products++;
        
        return $post_id;
    }
    
    /**
     * Display import results
     */
    private function display_results() {
        $this->log_message("\n📊 Import Results:");
        $this->log_message("  Strains imported: " . $this->imported_strains);
        $this->log_message("  Products imported: " . $this->imported_products);
        $this->log_message("  Items skipped: " . $this->skipped_items);
        $this->log_message("  Errors: " . count($this->errors));
        
        if (!empty($this->errors)) {
            $this->log_message("\n❌ Errors encountered:");
            foreach ($this->errors as $error) {
                $this->log_message("  • $error");
            }
        }
        
        if ($this->imported_strains > 0 || $this->imported_products > 0) {
            $this->log_message("\n🎉 Import completed successfully!");
            $this->log_message("👉 Check WordPress Admin > Strains and Products");
        } else {
            $this->log_message("\n⚠️  No items were imported. Check your CSV files and try again.");
        }
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
            WP_CLI::error($message, false);
        } else {
            echo "ERROR: " . $message . "\n";
        }
    }
}

// Auto-execute if running via WP-CLI
if (defined('WP_CLI') && WP_CLI) {
    $importer = new SkyWorldDataImporter();
    
    // Look for CSV files in current directory
    $strains_files = glob('*strains*.csv');
    $products_files = glob('*products*.csv');
    
    $strains_csv = !empty($strains_files) ? $strains_files[0] : null;
    $products_csv = !empty($products_files) ? $products_files[0] : null;
    
    $importer->import_from_csv($strains_csv, $products_csv);
}

?>