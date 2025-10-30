<?php
/**
 * Import COA PDFs from coas/ directory
 * Uploads PDFs and links them to products by batch number
 * Run this via: wp eval-file import-coas.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/wp-load.php');
    require_once ABSPATH;
}

echo "Starting COA import...\n\n";

$coas_dir = __DIR__ . '/coas/';

if (!is_dir($coas_dir)) {
    die("Error: COAs directory not found!\n");
}

$pdf_files = glob($coas_dir . '*.pdf');
$coa_count = 0;
$linked_count = 0;
$not_found = array();

foreach ($pdf_files as $pdf_file) {
    $filename = basename($pdf_file);
    
    // Extract batch number from filename
    // Format: COA-SW3725J-SP.pdf -> SW3725J-SP
    preg_match('/COA-([^-]+-\w+)\.pdf/i', $filename, $matches);
    if (empty($matches[1])) {
        echo "Could not extract batch number from: {$filename}\n";
        continue;
    }
    
    $batch_number = $matches[1];
    
    // Check if this file is already uploaded
    $existing_attachment = get_posts(array(
        'post_type' => 'attachment',
        'post_mime_type' => 'application/pdf',
        'meta_key' => 'batch_number',
        'meta_value' => $batch_number,
        'posts_per_page' => 1
    ));
    
    if (!empty($existing_attachment)) {
        $attachment_id = $existing_attachment[0]->ID;
        echo "COA already exists for batch: {$batch_number}\n";
    } else {
        // Upload the file
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        
        $upload = wp_upload_bits($filename, null, file_get_contents($pdf_file));
        
        if (!$upload['error']) {
            $wp_filetype = wp_check_filetype($filename, null);
            
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            
            $attachment_id = wp_insert_attachment($attachment, $upload['file']);
            
            if (!is_wp_error($attachment_id)) {
                $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                wp_update_attachment_metadata($attachment_id, $attach_data);
                
                // Store batch number in attachment meta
                update_post_meta($attachment_id, 'batch_number', $batch_number);
                
                echo "Uploaded COA: {$filename} (Batch: {$batch_number})\n";
                $coa_count++;
            } else {
                echo "Error uploading: {$filename}\n";
                continue;
            }
        } else {
            echo "Upload error for: {$filename}\n";
            continue;
        }
    }
    
    // Find and link product with matching batch number
    if ($attachment_id) {
        $products = get_posts(array(
            'post_type' => 'cannabis_product',
            'meta_query' => array(
                array(
                    'key' => 'batch_number',
                    'value' => $batch_number,
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        ));
        
        if (!empty($products)) {
            $product_id = $products[0]->ID;
            
            // Attach COA to product
            update_field('coa_file', $attachment_id, $product_id);
            
            // Add attachment relationship
            $current_attachments = get_field('coa_attachments', $product_id);
            if (!is_array($current_attachments)) {
                $current_attachments = array();
            }
            if (!in_array($attachment_id, $current_attachments)) {
                $current_attachments[] = $attachment_id;
                update_field('coa_attachments', $current_attachments, $product_id);
            }
            
            echo "  -> Linked to product: " . get_the_title($product_id) . "\n";
            $linked_count++;
        } else {
            echo "  -> No product found with batch: {$batch_number}\n";
            $not_found[] = $batch_number;
        }
    }
}

echo "\n=== Import Summary ===\n";
echo "COAs uploaded: {$coa_count}\n";
echo "Products linked: {$linked_count}\n";

if (!empty($not_found)) {
    echo "\nBatch numbers without products:\n";
    foreach ($not_found as $batch) {
        echo "  - {$batch}\n";
    }
}

echo "\nImport complete!\n";

