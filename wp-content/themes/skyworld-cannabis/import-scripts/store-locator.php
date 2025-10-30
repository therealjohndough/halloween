<?php
/**
 * Skyworld Store Locator Integration
 * Integrates with Agile Store Locator plugin for retailer locations
 */

if (!defined('ABSPATH')) {
    echo "This script must be run within WordPress.\n";
    exit;
}

class SkyworldStoreLocator {
    
    private $upload_dir;
    private $stores_data_file;
    
    public function __construct() {
        $upload_dir = wp_upload_dir();
        $this->upload_dir = $upload_dir['basedir'];
        $this->stores_data_file = $this->upload_dir . '/skyworld-import/store-locations.json';
    }
    
    /**
     * Initialize store locator data
     */
    public function setup_store_data() {
        echo "Setting up Skyworld store locator data...\n";
        
        // Create sample retailer data if file doesn't exist
        if (!file_exists($this->stores_data_file)) {
            $this->create_sample_store_data();
        }
        
        // Import stores into Agile Store Locator
        $this->import_stores_to_asl();
        
        echo "Store locator setup complete!\n";
    }
    
    /**
     * Create sample retailer data for New York State
     */
    private function create_sample_store_data() {
        $sample_stores = [
            [
                'title' => 'Higher Standards - Manhattan',
                'description' => 'Premium cannabis dispensary in the heart of NYC',
                'street' => '123 Broadway',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'United States',
                'lat' => '40.7505',
                'lng' => '-73.9910',
                'phone' => '(212) 555-0123',
                'website' => 'https://higherstandards-nyc.com',
                'email' => 'info@higherstandards-nyc.com',
                'open_hours' => 'Mon-Sat: 10am-9pm, Sun: 12pm-8pm',
                'categories' => ['Dispensary', 'Delivery'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower', 'pre-roll'],
                'priority' => 1
            ],
            [
                'title' => 'Green Leaf Collective - Brooklyn',
                'description' => 'Community-focused cannabis retailer serving Brooklyn',
                'street' => '456 Atlantic Avenue', 
                'city' => 'Brooklyn',
                'state' => 'NY',
                'postal_code' => '11217',
                'country' => 'United States',
                'lat' => '40.6892',
                'lng' => '-73.9442',
                'phone' => '(718) 555-0456',
                'website' => 'https://greenleafcollective.com',
                'email' => 'hello@greenleafcollective.com',
                'open_hours' => 'Daily: 9am-10pm',
                'categories' => ['Dispensary'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower', 'pre-roll', 'concentrate'],
                'priority' => 1
            ],
            [
                'title' => 'Empire Cannabis Co. - Albany',
                'description' => 'New York\'s premier cannabis destination in the capital region',
                'street' => '789 State Street',
                'city' => 'Albany', 
                'state' => 'NY',
                'postal_code' => '12203',
                'country' => 'United States',
                'lat' => '42.6526',
                'lng' => '-73.7562',
                'phone' => '(518) 555-0789',
                'website' => 'https://empirecannabisco.com',
                'email' => 'contact@empirecannabisco.com',
                'open_hours' => 'Mon-Thu: 10am-8pm, Fri-Sat: 10am-9pm, Sun: 11am-7pm',
                'categories' => ['Dispensary', 'Medical'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower'],
                'priority' => 2
            ],
            [
                'title' => 'Rochester Relief - Rochester',
                'description' => 'Medical and recreational cannabis serving Western NY',
                'street' => '321 East Avenue',
                'city' => 'Rochester',
                'state' => 'NY', 
                'postal_code' => '14604',
                'country' => 'United States',
                'lat' => '43.1566',
                'lng' => '-77.6088',
                'phone' => '(585) 555-0321',
                'website' => 'https://rochesterrelief.com',
                'email' => 'info@rochesterrelief.com',
                'open_hours' => 'Mon-Sat: 9am-9pm, Sun: 10am-8pm',
                'categories' => ['Dispensary', 'Medical', 'Delivery'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower', 'pre-roll'],
                'priority' => 2
            ],
            [
                'title' => 'Buffalo Bud Company - Buffalo',
                'description' => 'Buffalo\'s friendliest cannabis retailer',
                'street' => '654 Elmwood Avenue',
                'city' => 'Buffalo',
                'state' => 'NY',
                'postal_code' => '14222',
                'country' => 'United States',
                'lat' => '42.9017',
                'lng' => '-78.8487',
                'phone' => '(716) 555-0654',
                'website' => 'https://buffalobud.com', 
                'email' => 'hello@buffalobud.com',
                'open_hours' => 'Daily: 10am-9pm',
                'categories' => ['Dispensary'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower', 'pre-roll'],
                'priority' => 2
            ],
            [
                'title' => 'Syracuse Select - Syracuse',
                'description' => 'Central NY\'s premium cannabis experience',
                'street' => '987 South Salina Street',
                'city' => 'Syracuse',
                'state' => 'NY',
                'postal_code' => '13202',
                'country' => 'United States',
                'lat' => '43.0391',
                'lng' => '-76.1474',
                'phone' => '(315) 555-0987',
                'website' => 'https://syracuseselect.com',
                'email' => 'info@syracuseselect.com',
                'open_hours' => 'Mon-Sat: 10am-8pm, Sun: 12pm-6pm',
                'categories' => ['Dispensary', 'Medical'],
                'marker_id' => '1',
                'is_skyworld_partner' => true,
                'skyworld_products' => ['flower'],
                'priority' => 3
            ]
        ];
        
        // Ensure directory exists
        wp_mkdir_p(dirname($this->stores_data_file));
        
        // Save sample data
        file_put_contents($this->stores_data_file, json_encode($sample_stores, JSON_PRETTY_PRINT));
        
        echo "Created sample store data at: " . $this->stores_data_file . "\n";
    }
    
    /**
     * Import stores into Agile Store Locator plugin
     */
    private function import_stores_to_asl() {
        global $wpdb;
        
        // Check if ASL plugin is active
        if (!$this->is_asl_plugin_active()) {
            echo "Agile Store Locator plugin not found. Installing sample data for future use.\n";
            return;
        }
        
        $stores_json = file_get_contents($this->stores_data_file);
        $stores = json_decode($stores_json, true);
        
        if (!$stores) {
            echo "No store data found or invalid JSON.\n";
            return;
        }
        
        $asl_stores_table = $wpdb->prefix . 'asl_stores';
        $asl_categories_table = $wpdb->prefix . 'asl_categories';
        $asl_stores_categories_table = $wpdb->prefix . 'asl_stores_categories';
        
        // Clear existing Skyworld partner stores
        $wpdb->query("DELETE FROM {$asl_stores_table} WHERE description LIKE '%Skyworld%' OR title LIKE '%Skyworld%'");
        
        $imported_count = 0;
        
        foreach ($stores as $store) {
            // Insert store
            $store_data = [
                'title' => sanitize_text_field($store['title']),
                'description' => sanitize_textarea_field($store['description']),
                'street' => sanitize_text_field($store['street']),
                'city' => sanitize_text_field($store['city']),
                'state' => sanitize_text_field($store['state']),
                'postal_code' => sanitize_text_field($store['postal_code']),
                'country' => sanitize_text_field($store['country']),
                'lat' => floatval($store['lat']),
                'lng' => floatval($store['lng']),
                'phone' => sanitize_text_field($store['phone']),
                'website' => esc_url($store['website']),
                'email' => sanitize_email($store['email']),
                'open_hours' => sanitize_text_field($store['open_hours']),
                'marker_id' => intval($store['marker_id']),
                'is_disabled' => 0,
                'created_on' => current_time('mysql')
            ];
            
            $inserted = $wpdb->insert($asl_stores_table, $store_data);
            
            if ($inserted) {
                $store_id = $wpdb->insert_id;
                
                // Handle categories
                if (!empty($store['categories'])) {
                    foreach ($store['categories'] as $category_name) {
                        $category_id = $this->get_or_create_asl_category($category_name);
                        if ($category_id) {
                            $wpdb->insert($asl_stores_categories_table, [
                                'store_id' => $store_id,
                                'category_id' => $category_id
                            ]);
                        }
                    }
                }
                
                // Add custom meta for Skyworld integration
                if ($store['is_skyworld_partner']) {
                    update_option("asl_store_{$store_id}_skyworld_partner", true);
                    update_option("asl_store_{$store_id}_skyworld_products", $store['skyworld_products']);
                    update_option("asl_store_{$store_id}_priority", $store['priority']);
                }
                
                $imported_count++;
                echo "Imported store: {$store['title']} (ID: {$store_id})\n";
            } else {
                echo "Failed to import store: {$store['title']}\n";
            }
        }
        
        echo "Imported {$imported_count} stores into Agile Store Locator.\n";
    }
    
    /**
     * Check if Agile Store Locator plugin is active
     */
    private function is_asl_plugin_active() {
        return is_plugin_active('agile-store-locator/agile-store-locator.php') || 
               class_exists('AgileStoreLocator');
    }
    
    /**
     * Get or create ASL category
     */
    private function get_or_create_asl_category($category_name) {
        global $wpdb;
        
        $asl_categories_table = $wpdb->prefix . 'asl_categories';
        
        // Check if category exists
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$asl_categories_table} WHERE category_name = %s",
            $category_name
        ));
        
        if ($existing) {
            return $existing;
        }
        
        // Create new category
        $inserted = $wpdb->insert($asl_categories_table, [
            'category_name' => sanitize_text_field($category_name),
            'icon' => 'icon-store', // Default icon
            'is_active' => 1,
            'created_on' => current_time('mysql')
        ]);
        
        return $inserted ? $wpdb->insert_id : false;
    }
    
    /**
     * Generate store locator shortcode with Skyworld branding
     */
    public function generate_store_locator_shortcode() {
        $shortcode = '[ASL_STORELOCATOR 
            map_provider="google_map"
            head_title="Find Skyworld Cannabis Near You"
            description="Locate authorized retailers carrying our premium cannabis products"
            map_region="US"
            default_lat="42.9896"
            default_lng="-78.9428"
            zoom="7"
            search_type="0"
            template="default"
            color_scheme="#f15b27"
        ]';
        
        echo "Store Locator Shortcode:\n";
        echo $shortcode . "\n\n";
        
        return $shortcode;
    }
    
    /**
     * Add Skyworld-specific store locator styling
     */
    public function add_custom_asl_styles() {
        $custom_css = '
/* Skyworld Store Locator Customization */
.asl-cont .asl-panel .asl-head-title {
    color: #f15b27 !important;
    font-family: "Montserrat", sans-serif !important;
}

.asl-cont .asl-panel .btn-asl {
    background-color: #f15b27 !important;
    border-color: #f15b27 !important;
}

.asl-cont .asl-panel .btn-asl:hover {
    background-color: #54a5db !important;
    border-color: #54a5db !important;
}

.asl-store-cont .asl-card {
    border-left: 3px solid #f15b27;
}

.asl-store-cont .asl-card .asl-card-title {
    color: #f15b27 !important;
}

/* NY State outline integration */
.asl-cont .asl-panel:before {
    content: "";
    position: absolute;
    top: 10px;
    right: 10px;
    width: 40px;
    height: 40px;
    background: url("data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'><path d=\'M20,30 L80,30 L75,70 L25,70 Z\' fill=\'%23f15b27\' opacity=\'0.3\'/></svg>") no-repeat;
    background-size: contain;
}
';
        
        $css_file = get_template_directory() . '/assets/asl-custom.css';
        file_put_contents($css_file, $custom_css);
        
        echo "Created custom ASL styles at: {$css_file}\n";
    }
}

// Run the store locator setup
$store_locator = new SkyworldStoreLocator();

if (defined('WP_CLI') && WP_CLI) {
    $store_locator->setup_store_data();
    $store_locator->generate_store_locator_shortcode();
    $store_locator->add_custom_asl_styles();
} else {
    if (current_user_can('manage_options')) {
        $store_locator->setup_store_data();
        $store_locator->generate_store_locator_shortcode();
        $store_locator->add_custom_asl_styles();
    } else {
        echo "You need administrator privileges to run this store locator setup.\n";
    }
}