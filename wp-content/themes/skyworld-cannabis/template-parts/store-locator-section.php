<?php
/**
 * Store Locator Section Template Part
 * Primary conversion CTA with map integration
 */
?>

<section class="store-locator-section" id="store-locator">
    <div class="container">
        <div class="store-locator-content">
            <div class="locator-info">
                <h2 class="locator-title">Find Skyworld Near You</h2>
                <p class="locator-description">
                    Ready to experience premium indoor flower? Locate authorized Skyworld retailers in your area.
                </p>
                
                <!-- Search Form / ASL Integration -->
                <?php if (function_exists('asl_shortcode') || class_exists('AgileStoreLocator')) : ?>
                    <!-- Agile Store Locator Integration -->
                    <div class="asl-integration">
                        <?php echo do_shortcode('[ASL_STORELOCATOR 
                            map_provider="google_map"
                            head_title=""
                            description=""
                            map_region="US"
                            default_lat="42.9896"
                            default_lng="-78.9428"
                            zoom="7"
                            search_type="0"
                            template="default"
                            color_scheme="#f15b27"
                            distance_unit="Miles"
                            show_categories="1"
                            category_bound="1"
                        ]'); ?>
                    </div>
                <?php else : ?>
                    <!-- Fallback Search Form -->
                    <form class="locator-search-form" id="store-search-form">
                        <div class="search-input-group">
                            <label for="location-input" class="sr-only">Enter your zip code or city</label>
                            <input type="text" id="location-input" placeholder="Enter ZIP code or city" required>
                            <button type="submit" class="btn btn-primary">Find Stores</button>
                        </div>
                    </form>
                    
                    <!-- Store Results -->
                    <div class="store-results" id="store-results">
                        <?php
                        // Load store data from JSON
                        $stores_file = get_template_directory() . '/assets/store-locations.json';
                        if (file_exists($stores_file)) {
                            $stores_json = file_get_contents($stores_file);
                            $stores = json_decode($stores_json, true);
                            
                            if ($stores && is_array($stores)) {
                                echo '<div class="stores-grid">';
                                foreach ($stores as $store) :
                                    ?>
                                    <div class="store-card">
                                        <h3><?php echo esc_html($store['title']); ?></h3>
                                        <p class="store-address">
                                            <?php echo esc_html($store['street']); ?><br>
                                            <?php echo esc_html($store['city']); ?>, <?php echo esc_html($store['state']); ?> <?php echo esc_html($store['postal_code']); ?>
                                        </p>
                                        <?php if (!empty($store['phone'])) : ?>
                                            <p class="store-phone">
                                                <a href="tel:<?php echo esc_attr($store['phone']); ?>"><?php echo esc_html($store['phone']); ?></a>
                                            </p>
                                        <?php endif; ?>
                                        <div class="store-actions">
                                            <?php if (!empty($store['website'])) : ?>
                                                <a href="<?php echo esc_url($store['website']); ?>" target="_blank" class="btn btn-outline">Visit Website</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?> 
                            type="text" 
                            id="location-input" 
                            name="location" 
                            placeholder="Enter zip code or city" 
                            class="location-input"
                            autocomplete="postal-code"
                        >
                        <button type="submit" class="search-btn">
                            <span class="btn-text">Find Stores</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
                
                <!-- Quick Links -->
                <div class="locator-quick-links">
                    <p class="quick-links-label">Popular Areas:</p>
                    <div class="quick-links-list">
                        <button class="quick-link" data-location="New York, NY">NYC</button>
                        <button class="quick-link" data-location="Brooklyn, NY">Brooklyn</button>
                        <button class="quick-link" data-location="Albany, NY">Albany</button>
                        <button class="quick-link" data-location="Buffalo, NY">Buffalo</button>
                        <button class="quick-link" data-location="Rochester, NY">Rochester</button>
                    </div>
                </div>
                
                <!-- Features -->
                <div class="locator-features">
                    <div class="feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="var(--skyworld-orange)">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <span>Real-time hours</span>
                    </div>
                    <div class="feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="var(--skyworld-blue)">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span>Get directions</span>
                    </div>
                    <div class="feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="var(--skyworld-orange)">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        <span>Call ahead</span>
                    </div>
                </div>
            </div>
            
            <div class="locator-map">
                <!-- Map Container -->
                <div id="store-locator-map" class="map-container">
                    <!-- Map will be loaded here via JavaScript -->
                    <div class="map-placeholder">
                        <div class="placeholder-content">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="var(--skyworld-grey)">
                                <path d="M32 8c-8.837 0-16 7.163-16 16 0 16 16 32 16 32s16-16 16-32c0-8.837-7.163-16-16-16zm0 22c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z"/>
                            </svg>
                            <p>Interactive map loading...</p>
                            <button class="load-map-btn btn btn--primary" onclick="initStoreLocatorMap()">
                                Load Map
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Results Container -->
                <div id="store-results" class="store-results" style="display: none;">
                    <div class="results-header">
                        <h3 class="results-title">Nearby Retailers</h3>
                        <span class="results-count"></span>
                    </div>
                    <div class="results-list">
                        <!-- Store results will be populated here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Alternative CTA -->
        <div class="locator-alt-cta text-center">
            <p class="alt-cta-text">Can't find a retailer near you?</p>
            <a href="/contact" class="btn btn--outline">
                Request a Retailer
            </a>
        </div>
    </div>
</section>

<!-- Store Locator Data (for JavaScript) -->
<script type="application/json" id="store-locator-data">
<?php
// Load store data from JSON file
$stores_file = get_template_directory() . '/assets/store-locations.json';
if (file_exists($stores_file)) {
    echo file_get_contents($stores_file);
} else {
    // Fallback data
    echo json_encode([
        'stores' => [],
        'mapConfig' => [
            'center' => ['lat' => 42.9538, 'lng' => -75.5268],
            'zoom' => 7
        ]
    ]);
}
?>
</script>