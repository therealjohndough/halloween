<?php
/**
 * CSV Processor - Converts exported WordPress CSV to clean import format
 * Run this first to prepare your CSV files for import
 */

if (!defined('ABSPATH')) {
    echo "This script must be run within WordPress.\n";
    exit;
}

class SkyworldCSVProcessor {
    
    private $source_dir;
    private $output_dir;
    
    public function __construct() {
        $upload_dir = wp_upload_dir();
        $this->source_dir = $upload_dir['basedir'] . '/skyworld-source/';
        $this->output_dir = $upload_dir['basedir'] . '/skyworld-import/';
        
        if (!file_exists($this->source_dir)) {
            wp_mkdir_p($this->source_dir);
        }
        if (!file_exists($this->output_dir)) {
            wp_mkdir_p($this->output_dir);
        }
    }
    
    /**
     * Process all CSV files
     */
    public function process() {
        echo "Processing CSV files...\n";
        
        $this->process_strains();
        $this->process_products();
        
        echo "CSV processing complete!\n";
        echo "Files created in: " . $this->output_dir . "\n";
    }
    
    /**
     * Process strains CSV
     */
    private function process_strains() {
        $source_file = $this->source_dir . 'strains-export.csv';
        $output_file = $this->output_dir . 'strains.csv';
        
        if (!file_exists($source_file)) {
            echo "Source strains file not found: $source_file\n";
            echo "Please upload your Strains-Export CSV to: " . $this->source_dir . "\n";
            return;
        }
        
        $source = fopen($source_file, 'r');
        $output = fopen($output_file, 'w');
        
        // Read source header
        $source_header = fgetcsv($source);
        
        // Write clean header
        $clean_header = [
            'Title',
            'Content',
            'Excerpt', 
            'Slug',
            'genetics',
            'breeder',
            'breeder_source_url',
            'flowering_time',
            'aroma_profile',
            'flavor_profile',
            'terpene_profile_json',
            'meta_title',
            'meta_description',
            'Strain Types'
        ];
        fputcsv($output, $clean_header);
        
        $count = 0;
        while (($row = fgetcsv($source)) !== FALSE) {
            $data = array_combine($source_header, $row);
            
            $clean_row = [
                $data['Title'] ?? '',
                $data['Content'] ?? '',
                $data['Excerpt'] ?? '',
                $data['Slug'] ?? '',
                $data['genetics'] ?? '',
                $data['breeder'] ?? '',
                $data['breeder_source_url'] ?? '',
                $data['flowering_time'] ?? '',
                $data['aroma_profile'] ?? '',
                $data['flavor_profile'] ?? '',
                $data['terpene_profile_json'] ?? '',
                $data['meta_title'] ?? '',
                $data['meta_description'] ?? '',
                $data['Strain Types'] ?? ''
            ];
            
            fputcsv($output, $clean_row);
            $count++;
        }
        
        fclose($source);
        fclose($output);
        
        echo "Processed $count strains to: $output_file\n";
    }
    
    /**
     * Process products CSV
     */
    private function process_products() {
        $source_file = $this->source_dir . 'products-export.csv';
        $output_file = $this->output_dir . 'products.csv';
        
        if (!file_exists($source_file)) {
            echo "Source products file not found: $source_file\n";
            echo "Please upload your Cannabis-Products-Export CSV to: " . $this->source_dir . "\n";
            return;
        }
        
        $source = fopen($source_file, 'r');
        $output = fopen($output_file, 'w');
        
        // Read source header
        $source_header = fgetcsv($source);
        
        // Write clean header
        $clean_header = [
            'Title',
            'Content', 
            'Excerpt',
            'Slug',
            'batch_number',
            'strain_name',
            'lineage',
            'strain_type',
            'product_type',
            'package_sizes',
            'thc_percent',
            'cbd_percent',
            'cbg_percent',
            'thcv_percent',
            'terp_total',
            'terp1_name',
            'terp1_percent',
            'terp2_name',
            'terp2_percent',
            'terp3_name',
            'terp3_percent',
            'lab_name'
        ];
        fputcsv($output, $clean_header);
        
        $count = 0;
        while (($row = fgetcsv($source)) !== FALSE) {
            $data = array_combine($source_header, $row);
            
            $clean_row = [
                $data['Title'] ?? '',
                $data['Content'] ?? '',
                $data['Excerpt'] ?? '',
                $data['Slug'] ?? '',
                $data['batch_number'] ?? '',
                $data['strain_name'] ?? '',
                $data['lineage'] ?? '',
                $data['strain_type'] ?? '',
                $data['product_type'] ?? '',
                $data['package_sizes'] ?? '',
                $data['thc_percent'] ?? '',
                $data['cbd_percent'] ?? '',
                $data['cbg_percent'] ?? '',
                $data['thcv_percent'] ?? '',
                $data['terp_total'] ?? '',
                $data['terp1_name'] ?? '',
                $data['terp1_percent'] ?? '',
                $data['terp2_name'] ?? '',
                $data['terp2_percent'] ?? '',
                $data['terp3_name'] ?? '',
                $data['terp3_percent'] ?? '',
                $data['lab_name'] ?? ''
            ];
            
            fputcsv($output, $clean_row);
            $count++;
        }
        
        fclose($source);
        fclose($output);
        
        echo "Processed $count products to: $output_file\n";
    }
}

// Run the processor
$processor = new SkyworldCSVProcessor();

if (defined('WP_CLI') && WP_CLI) {
    $processor->process();
} else {
    if (current_user_can('manage_options')) {
        $processor->process();
    } else {
        echo "You need administrator privileges to run this processor.\n";
    }
}