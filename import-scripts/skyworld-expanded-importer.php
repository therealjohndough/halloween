<?php
/**
 * Enhanced Skyworld Strains Import Script
 * Imports expanded strain library with 16 strains
 */

// Prevent direct access
if (!defined('WP_CLI') && !is_admin()) {
    exit('Access denied');
}

/**
 * Import expanded strain data from CSV
 */
function skyworld_import_expanded_strains() {
    $csv_file = dirname(__FILE__) . '/../skyworld-strains-library-import.csv';
    
    if (!file_exists($csv_file)) {
        WP_CLI::error("CSV file not found: $csv_file");
        return;
    }
    
    $handle = fopen($csv_file, 'r');
    if (!$handle) {
        WP_CLI::error("Could not open CSV file");
        return;
    }
    
    // Read header row
    $headers = fgetcsv($handle);
    $imported = 0;
    $skipped = 0;
    
    WP_CLI::log("Starting expanded strain import...");
    
    while (($data = fgetcsv($handle)) !== false) {
        if (empty($data[1])) continue; // Skip empty title rows
        
        $strain_data = array_combine($headers, $data);
        
        // Check if strain already exists
        $existing = get_page_by_title($strain_data['post_title'], OBJECT, 'strain');
        if ($existing) {
            WP_CLI::log("Strain '{$strain_data['post_title']}' already exists, updating...");
            $post_id = $existing->ID;
            
            // Update post
            wp_update_post([
                'ID' => $post_id,
                'post_excerpt' => $strain_data['excerpt'],
                'post_status' => 'publish'
            ]);
        } else {
            // Create new strain post
            $post_id = wp_insert_post([
                'post_title' => $strain_data['post_title'],
                'post_type' => 'strain',
                'post_status' => 'publish',
                'post_excerpt' => $strain_data['excerpt'],
                'post_content' => '', // Add detailed content if needed
            ]);
            
            if (is_wp_error($post_id)) {
                WP_CLI::warning("Failed to create strain: {$strain_data['post_title']}");
                $skipped++;
                continue;
            }
            
            WP_CLI::log("Created new strain: {$strain_data['post_title']}");
        }
        
        // Update ACF fields
        if (function_exists('update_field')) {
            // Basic strain info
            update_field('genetics', $strain_data['genetics'], $post_id);
            update_field('breeder', $strain_data['breeder'], $post_id);
            update_field('breeder_source_url', $strain_data['breeder_source_url'], $post_id);
            update_field('flowering_time', $strain_data['flowering_time'], $post_id);
            update_field('aroma_profile', $strain_data['aroma_profile'], $post_id);
            update_field('flavor_profile', $strain_data['flavor_profile'], $post_id);
            
            // SEO fields
            update_field('meta_title', $strain_data['meta_title'], $post_id);
            update_field('meta_description', $strain_data['meta_description'], $post_id);
            
            // Parse and save terpene profile JSON
            if (!empty($strain_data['terpene_profile_json'])) {
                $terpenes = json_decode($strain_data['terpene_profile_json'], true);
                if ($terpenes && is_array($terpenes)) {
                    update_field('terpene_profile', $terpenes, $post_id);
                }
            }
            
            // Set strain type based on genetics (basic logic)
            $genetics_lower = strtolower($strain_data['genetics']);
            if (strpos($genetics_lower, 'indica') !== false) {
                $strain_type = 'indica';
            } elseif (strpos($genetics_lower, 'sativa') !== false) {
                $strain_type = 'sativa';
            } else {
                $strain_type = 'hybrid';
            }
            update_field('strain_type', $strain_type, $post_id);
        }
        
        $imported++;
    }
    
    fclose($handle);
    
    WP_CLI::success("Enhanced import complete! Imported: $imported, Skipped: $skipped");
    WP_CLI::log("Total strains in library: " . wp_count_posts('strain')->publish);
}

// Register WP-CLI command
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('skyworld import-expanded-strains', 'skyworld_import_expanded_strains');
}

// For direct execution
if (defined('WP_CLI') && WP_CLI && isset($argv[1]) && $argv[1] === 'import-expanded-strains') {
    skyworld_import_expanded_strains();
}
?>