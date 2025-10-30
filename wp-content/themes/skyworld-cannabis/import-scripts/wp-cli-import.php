<?php
/**
 * WP-CLI command to import Skyworld strains and products from CSV
 * Usage: wp skyworld import csv /path/to/sample-content.csv
 */

if (defined('WP_CLI') && WP_CLI) {
    
    class Skyworld_Import_Command extends WP_CLI_Command {
        
        /**
         * Import strains and products from CSV file
         *
         * ## OPTIONS
         *
         * <file>
         * : Path to the CSV file to import
         *
         * ## EXAMPLES
         *
         *     wp skyworld import csv wp-content/uploads/sample-content.csv
         */
        public function csv($args, $assoc_args) {
            $file = $args[0];
            
            if (!file_exists($file)) {
                WP_CLI::error("File not found: $file");
            }
            
            WP_CLI::line("Starting import from: $file");
            
            $csv = array_map('str_getcsv', file($file));
            $header = array_shift($csv);
            
            $imported = 0;
            $skipped = 0;
            
            foreach ($csv as $row) {
                $data = array_combine($header, $row);
                
                if (empty($data['post_title'])) {
                    $skipped++;
                    continue;
                }
                
                if ($data['post_type'] === 'strain') {
                    $result = $this->import_strain($data);
                    if ($result) {
                        $imported++;
                        WP_CLI::line("✓ Imported strain: " . $data['post_title']);
                    } else {
                        $skipped++;
                        WP_CLI::warning("✗ Failed to import strain: " . $data['post_title']);
                    }
                } elseif ($data['post_type'] === 'cannabis_product') {
                    $result = $this->import_product($data);
                    if ($result) {
                        $imported++;
                        WP_CLI::line("✓ Imported product: " . $data['post_title']);
                    } else {
                        $skipped++;
                        WP_CLI::warning("✗ Failed to import product: " . $data['post_title']);
                    }
                } else {
                    $skipped++;
                    WP_CLI::warning("Unknown post type: " . $data['post_type']);
                }
            }
            
            WP_CLI::success("Import complete! Imported: $imported, Skipped: $skipped");
        }
        
        private function import_strain($data) {
            // Check if strain already exists
            $existing = get_page_by_title($data['post_title'], OBJECT, 'strains');
            if ($existing) {
                WP_CLI::line("Strain already exists: " . $data['post_title']);
                return $existing->ID;
            }
            
            $post_id = wp_insert_post([
                'post_title' => sanitize_text_field($data['post_title']),
                'post_content' => wp_kses_post($data['post_content']),
                'post_type' => 'strains',
                'post_status' => 'publish',
                'post_name' => sanitize_title($data['post_title'])
            ]);
            
            if (!$post_id || is_wp_error($post_id)) {
                return false;
            }
            
            // Set ACF fields
            if (function_exists('update_field')) {
                update_field('thc_content', floatval($data['thc_content']), $post_id);
                update_field('cbd_content', floatval($data['cbd_content']), $post_id);
                update_field('terpenes', sanitize_text_field($data['terpenes']), $post_id);
                update_field('effects', sanitize_text_field($data['effects']), $post_id);
                update_field('flavors', sanitize_text_field($data['flavors']), $post_id);
                
                if (!empty($data['coa_file'])) {
                    update_field('coa_file', sanitize_text_field($data['coa_file']), $post_id);
                }
            }
            
            // Set featured image if provided
            if (!empty($data['featured_image'])) {
                $this->set_featured_image($post_id, $data['featured_image']);
            }
            
            return $post_id;
        }
        
        private function import_product($data) {
            // Check if product already exists
            $existing = get_page_by_title($data['post_title'], OBJECT, 'products');
            if ($existing) {
                WP_CLI::line("Product already exists: " . $data['post_title']);
                return $existing->ID;
            }
            
            $post_id = wp_insert_post([
                'post_title' => sanitize_text_field($data['post_title']),
                'post_content' => wp_kses_post($data['post_content']),
                'post_type' => 'products',
                'post_status' => 'publish',
                'post_name' => sanitize_title($data['post_title'])
            ]);
            
            if (!$post_id || is_wp_error($post_id)) {
                return false;
            }
            
            // Find and link related strain
            if (!empty($data['strain_name'])) {
                $strain = get_page_by_title(sanitize_text_field($data['strain_name']), OBJECT, 'strains');
                if ($strain && function_exists('update_field')) {
                    update_field('related_strain', $strain->ID, $post_id);
                }
            }
            
            // Set ACF fields
            if (function_exists('update_field')) {
                update_field('thc_content', floatval($data['thc_content']), $post_id);
                update_field('cbd_content', floatval($data['cbd_content']), $post_id);
                update_field('product_type', sanitize_text_field($data['product_type']), $post_id);
                update_field('size_weight', sanitize_text_field($data['size_weight']), $post_id);
                update_field('sku', sanitize_text_field($data['sku']), $post_id);
                
                if (!empty($data['coa_file'])) {
                    update_field('coa_file', sanitize_text_field($data['coa_file']), $post_id);
                }
            }
            
            // Set featured image if provided
            if (!empty($data['featured_image'])) {
                $this->set_featured_image($post_id, $data['featured_image']);
            }
            
            return $post_id;
        }
        
        private function set_featured_image($post_id, $image_filename) {
            // Look for image in theme assets directory
            $theme_path = get_template_directory();
            $possible_paths = [
                $theme_path . '/assets/images/strains/' . $image_filename,
                $theme_path . '/assets/images/products/' . $image_filename,
                $theme_path . '/assets/images/' . $image_filename
            ];
            
            foreach ($possible_paths as $image_path) {
                if (file_exists($image_path)) {
                    // Image exists, but for now just store the filename
                    // In production, you'd upload to media library
                    update_post_meta($post_id, '_thumbnail_image', $image_filename);
                    break;
                }
            }
        }
    }
    
    WP_CLI::add_command('skyworld', 'Skyworld_Import_Command');
}