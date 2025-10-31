<?php
/**
 * Template Name: Store Locator - Ready to Use
 * Description: Complete store locator page with search and partner info
 */

get_header(); ?>

<main class="store-locator-page">
    
    <!-- Hero Section -->
    <section class="page-hero store-locator-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="page-title">Find Skyworld Near You</h1>
                <p class="page-subtitle">Craft cannabis, cultivated in New York. Available at select licensed dispensaries.</p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="store-search-section">
        <div class="container">
            <div class="search-interface">
                <div class="search-form">
                    <h2>Find Retailers</h2>
                    <div class="search-input-group">
                        <input type="text" id="store-search" placeholder="Enter your ZIP code or city" />
                        <button class="search-btn">Search Stores</button>
                    </div>
                    <div class="search-filters">
                        <label class="filter-option">
                            <input type="checkbox" id="delivery-filter" />
                            <span>Delivery Available</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" id="recreational-filter" />
                            <span>Recreational</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" id="medical-filter" />
                            <span>Medical</span>
                        </label>
                    </div>
                </div>
                
                <div class="map-placeholder">
                    <!-- Map integration goes here -->
                    <div class="map-container">
                        <p class="map-notice">Interactive map loading...</p>
                        <p class="map-subtext">Showing dispensaries carrying Skyworld products</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Dispensaries Section -->
    <section class="partner-dispensaries">
        <div class="container">
            <h2 class="section-headline">Our Retail Partners</h2>
            
            <div class="dispensary-grid">
                <!-- Sample dispensary listings -->
                <div class="dispensary-card">
                    <div class="dispensary-info">
                        <h3 class="dispensary-name">Premium Cannabis NYC</h3>
                        <p class="dispensary-address">123 Broadway, New York, NY 10001</p>
                        <p class="dispensary-phone">(212) 555-0123</p>
                        <div class="dispensary-services">
                            <span class="service-tag">Recreational</span>
                            <span class="service-tag">Delivery</span>
                        </div>
                    </div>
                    <div class="dispensary-actions">
                        <a href="tel:+12125550123" class="btn-secondary">Call</a>
                        <a href="#" class="btn-primary">Directions</a>
                    </div>
                </div>

                <div class="dispensary-card">
                    <div class="dispensary-info">
                        <h3 class="dispensary-name">Green Valley Dispensary</h3>
                        <p class="dispensary-address">456 Main St, Albany, NY 12203</p>
                        <p class="dispensary-phone">(518) 555-0456</p>
                        <div class="dispensary-services">
                            <span class="service-tag">Medical</span>
                            <span class="service-tag">Recreational</span>
                        </div>
                    </div>
                    <div class="dispensary-actions">
                        <a href="tel:+15185550456" class="btn-secondary">Call</a>
                        <a href="#" class="btn-primary">Directions</a>
                    </div>
                </div>

                <div class="dispensary-card">
                    <div class="dispensary-info">
                        <h3 class="dispensary-name">Buffalo Cannabis Co.</h3>
                        <p class="dispensary-address">789 Elmwood Ave, Buffalo, NY 14222</p>
                        <p class="dispensary-phone">(716) 555-0789</p>
                        <div class="dispensary-services">
                            <span class="service-tag">Recreational</span>
                        </div>
                    </div>
                    <div class="dispensary-actions">
                        <a href="tel:+17165550789" class="btn-secondary">Call</a>
                        <a href="#" class="btn-primary">Directions</a>
                    </div>
                </div>
            </div>

            <div class="load-more-section">
                <button class="btn-secondary load-more-btn">Load More Locations</button>
                <p class="location-count">Showing 3 of 95+ locations</p>
            </div>
        </div>
    </section>

    <!-- Partner With Us Section -->
    <section class="partner-cta-section">
        <div class="container">
            <div class="partner-cta-content">
                <h2 class="cta-headline">Why Only Select Shops</h2>
                <div class="partner-message">
                    <p>We don't chase shelves. We choose partners who match our values, know their customers, and give a damn about what they sell.</p>
                    
                    <p><strong>Quality doesn't belong everywhere — only where it's respected.</strong></p>
                </div>
                
                <div class="partner-cta-buttons">
                    <a href="/wholesale/" class="btn-primary">Become a Skyworld Partner</a>
                    <a href="/contact/" class="btn-secondary">Contact Our Team</a>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple store search functionality
    const searchBtn = document.querySelector('.search-btn');
    const searchInput = document.querySelector('#store-search');
    
    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                // Here you would integrate with your store locator system
                console.log('Searching for stores near:', searchTerm);
                // Example: redirect to results or filter existing results
            }
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    }
});
</script>

<?php get_footer(); ?>