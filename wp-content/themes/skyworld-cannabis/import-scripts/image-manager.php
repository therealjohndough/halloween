<?php
/**
 * Skyworld Image Manager
 * Handles bulk image imports and WordPress media library integration
 */

if (!defined('ABSPATH')) {
    echo "This script must be run within WordPress.\n";
    exit;
}

class SkyworldImageManager {
    
    private $upload_dir;
    private $images_dir;
    
    public function __construct() {
        $upload_dir = wp_upload_dir();
        $this->upload_dir = $upload_dir['basedir'];
        $this->images_dir = $this->upload_dir . '/skyworld-images/';
        
        if (!file_exists($this->images_dir)) {
            wp_mkdir_p($this->images_dir);
            wp_mkdir_p($this->images_dir . 'strains/');
            wp_mkdir_p($this->images_dir . 'products/');
        }
    }
    
    /**
     * Main image processing function
     */
    public function process_images() {
        echo "Starting Skyworld Image Processing...\n";
        
        $this->process_strain_images();
        $this->process_product_images();
        
        echo "Image processing complete!\n";
    }
    
    /**
     * Process strain images
     */
    private function process_strain_images() {
        echo "Processing strain images...\n";
        
        $strains = get_posts([
            'post_type' => 'strain',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ]);
        
        foreach ($strains as $strain) {
            if (has_post_thumbnail($strain->ID)) {
                echo "Strain '{$strain->post_title}' already has thumbnail, skipping.\n";
                continue;
            }
            
            $image_path = $this->find_strain_image($strain->post_title, $strain->post_name);
            
            if ($image_path) {
                $attachment_id = $this->import_image_to_media_library($image_path, $strain->post_title . ' Strain');
                
                if ($attachment_id) {
                    set_post_thumbnail($strain->ID, $attachment_id);
                    echo "Set thumbnail for strain: {$strain->post_title} (ID: {$strain->ID})\n";
                } else {
                    echo "Failed to import image for strain: {$strain->post_title}\n";
                }
            } else {
                echo "No image found for strain: {$strain->post_title}\n";
            }
        }
    }
    
    /**
     * Process product images
     */
    private function process_product_images() {
        echo "Processing product images...\n";
        
        $products = get_posts([
            'post_type' => 'cannabis_product',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ]);
        
        foreach ($products as $product) {
            if (has_post_thumbnail($product->ID)) {
                echo "Product '{$product->post_title}' already has thumbnail, skipping.\n";
                continue;
            }
            
            // Try to find image by batch number first, then by product name
            $batch_number = get_field('batch_number', $product->ID);
            $strain_name = get_field('strain_name', $product->ID);
            
            $image_path = $this->find_product_image($product->post_title, $product->post_name, $batch_number, $strain_name);
            
            if ($image_path) {
                $attachment_id = $this->import_image_to_media_library($image_path, $product->post_title);
                
                if ($attachment_id) {
                    set_post_thumbnail($product->ID, $attachment_id);
                    echo "Set thumbnail for product: {$product->post_title} (ID: {$product->ID})\n";
                } else {
                    echo "Failed to import image for product: {$product->post_title}\n";
                }
            } else {
                echo "No image found for product: {$product->post_title}\n";
            }
        }
    }
    
    /**
     * Find strain image by various naming patterns
     */
    private function find_strain_image($title, $slug) {
        $search_names = [
            $slug,
            sanitize_file_name($title),
            strtolower(str_replace(' ', '-', $title)),
            strtolower(str_replace(' ', '_', $title)),
            strtolower(str_replace([' ', '-'], '', $title))
        ];
        
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $search_dirs = [
            $this->images_dir . 'strains/',
            $this->images_dir,
            $this->upload_dir . '/'
        ];
        
        foreach ($search_dirs as $dir) {
            foreach ($search_names as $name) {
                foreach ($extensions as $ext) {
                    $file_path = $dir . $name . '.' . $ext;
                    if (file_exists($file_path)) {
                        return $file_path;
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * Find product image by batch number or strain association
     */
    private function find_product_image($title, $slug, $batch_number = '', $strain_name = '') {
        $search_names = [];
        
        // Try batch number first
        if ($batch_number) {
            $search_names[] = $batch_number;
            $search_names[] = strtolower($batch_number);
        }
        
        // Try product identifiers
        $search_names[] = $slug;
        $search_names[] = sanitize_file_name($title);
        $search_names[] = strtolower(str_replace(' ', '-', $title));
        $search_names[] = strtolower(str_replace(' ', '_', $title));
        
        // Try strain name variations
        if ($strain_name) {
            $search_names[] = sanitize_file_name($strain_name);
            $search_names[] = strtolower(str_replace(' ', '-', $strain_name));
        }
        
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $search_dirs = [
            $this->images_dir . 'products/',
            $this->images_dir . 'strains/',
            $this->images_dir,
            $this->upload_dir . '/'
        ];
        
        foreach ($search_dirs as $dir) {
            foreach ($search_names as $name) {
                foreach ($extensions as $ext) {
                    $file_path = $dir . $name . '.' . $ext;
                    if (file_exists($file_path)) {
                        return $file_path;
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * Import image to WordPress media library
     */
    private function import_image_to_media_library($file_path, $title) {
        if (!file_exists($file_path)) {
            return false;
        }
        
        $filename = basename($file_path);
        $upload_file = wp_upload_bits($filename, null, file_get_contents($file_path));
        
        if ($upload_file['error']) {
            echo "Upload error: " . $upload_file['error'] . "\n";
            return false;
        }
        
        $attachment = [
            'post_mime_type' => wp_check_filetype($filename)['type'],
            'post_title' => sanitize_text_field($title),
            'post_content' => '',
            'post_status' => 'inherit'
        ];
        
        $attachment_id = wp_insert_attachment($attachment, $upload_file['file']);
        
        if (is_wp_error($attachment_id)) {
            echo "Attachment error: " . $attachment_id->get_error_message() . "\n";
            return false;
        }
        
        // Generate image metadata
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
        wp_update_attachment_metadata($attachment_id, $attachment_data);
        
        return $attachment_id;
    }
    
    /**
     * Bulk download images from URLs (if you have image URLs)
     */
    public function download_images_from_csv($csv_file) {
        if (!file_exists($csv_file)) {
            echo "CSV file not found: $csv_file\n";
            return;
        }
        
        echo "Downloading images from CSV...\n";
        
        $handle = fopen($csv_file, 'r');
        $header = fgetcsv($handle);
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            $row = array_combine($header, $data);
            
            if (!empty($row['Image URL']) && !empty($row['Title'])) {
                $this->download_image($row['Image URL'], $row['Title'], $row['Post Type'] ?? 'product');
            }
        }
        
        fclose($handle);
        echo "Image download complete.\n";
    }
    
    /**
     * Download single image from URL
     */
    private function download_image($url, $title, $post_type) {
        $image_data = wp_remote_get($url);
        
        if (is_wp_error($image_data)) {
            echo "Failed to download image: $url\n";
            return false;
        }
        
        $filename = basename(parse_url($url, PHP_URL_PATH));
        if (!$filename) {
            $filename = sanitize_file_name($title) . '.jpg';
        }
        
        $upload_dir = $post_type === 'strain' ? 'strains/' : 'products/';
        $file_path = $this->images_dir . $upload_dir . $filename;
        
        file_put_contents($file_path, wp_remote_retrieve_body($image_data));
        
        echo "Downloaded: $filename\n";
        return $file_path;
    }
}

// Run the image manager
$image_manager = new SkyworldImageManager();

if (defined('WP_CLI') && WP_CLI) {
    $image_manager->process_images();
} else {
    if (current_user_can('manage_options')) {
        $image_manager->process_images();
    } else {
        echo "You need administrator privileges to run this image processor.\n";
    }
}