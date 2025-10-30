<?php
/**
 * Store Locator Section Template Part
 * Uses Agile Store Locator plugin for store locations
 */
?>

<section class="store-locator-section" id="store-locator">
    <div class="container">
        <div class="section-header">
            <h2>Find Skyworld Near You</h2>
            <p>Locate authorized retailers carrying Skyworld Cannabis products in New York</p>
        </div>
        
        <div class="store-locator-content">
            <?php
            // Display Agile Store Locator plugin
            if (shortcode_exists('ASL_STORELOCATOR')) {
                echo do_shortcode('[ASL_STORELOCATOR]');
            } elseif (function_exists('asl_shortcode') || class_exists('AgileStoreLocator')) {
                // Alternative shortcode format
                echo do_shortcode('[ASL_STORELOCATOR 
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
                ]');
            } else {
                // Fallback message when plugin is not available
                echo '<div class="store-locator-placeholder">';
                echo '<p>Store locator loading... Please ensure the Agile Store Locator plugin is installed and activated.</p>';
                echo '<p>Contact us for retailer information: <a href="mailto:info@skyworldcannabis.com">info@skyworldcannabis.com</a></p>';
                echo '</div>';
            }
            ?>
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