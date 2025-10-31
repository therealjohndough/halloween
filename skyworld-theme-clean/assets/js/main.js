/**
 * Skyworld Cannabis - Main JavaScript
 * Interactive elements, parallax effects, and smooth scrolling
 */

(function($) {
    'use strict';
    
    // Initialize everything when DOM is ready
    $(document).ready(function() {
        initHeroSlider();
        initSmoothScrolling();
        initHeaderScrollEffect();
        initVideoControls();
        initStoreLocator();
        initTerpeneWheel();
        initParallaxEffects();
        initMobileMenu();
    });
    
    /**
     * Hero Slider Functionality
     */
    function initHeroSlider() {
        const slides = $('.hero-slide');
        const dots = $('.hero-dot');
        const prevBtn = $('.hero-arrow--prev');
        const nextBtn = $('.hero-arrow--next');
        let currentSlide = 0;
        let autoplayInterval;
        
        if (slides.length <= 1) return;
        
        // Auto-play slides
        function startAutoplay() {
            autoplayInterval = setInterval(function() {
                nextSlide();
            }, 5000);
        }
        
        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }
        
        function goToSlide(index) {
            slides.removeClass('active');
            dots.removeClass('active');
            
            slides.eq(index).addClass('active');
            dots.eq(index).addClass('active');
            
            currentSlide = index;
        }
        
        function nextSlide() {
            const next = (currentSlide + 1) % slides.length;
            goToSlide(next);
        }
        
        function prevSlide() {
            const prev = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
            goToSlide(prev);
        }
        
        // Event listeners
        dots.on('click', function() {
            const index = $(this).data('slide');
            goToSlide(index);
            stopAutoplay();
            setTimeout(startAutoplay, 10000); // Restart after 10s
        });
        
        nextBtn.on('click', function() {
            nextSlide();
            stopAutoplay();
            setTimeout(startAutoplay, 10000);
        });
        
        prevBtn.on('click', function() {
            prevSlide();
            stopAutoplay();
            setTimeout(startAutoplay, 10000);
        });
        
        // Keyboard navigation
        $(document).on('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                stopAutoplay();
                setTimeout(startAutoplay, 10000);
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                stopAutoplay();
                setTimeout(startAutoplay, 10000);
            }
        });
        
        // Pause on hover
        $('.hero-section').hover(
            function() { stopAutoplay(); },
            function() { startAutoplay(); }
        );
        
        // Start autoplay
        startAutoplay();
    }
    
    /**
     * Smooth Scrolling for Anchor Links
     */
    function initSmoothScrolling() {
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(e) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
                location.hostname == this.hostname) {
                
                const target = $(this.hash);
                const targetElement = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (targetElement.length) {
                    e.preventDefault();
                    
                    $('html, body').animate({
                        scrollTop: targetElement.offset().top - 80 // Account for fixed header
                    }, 800, 'easeInOutCubic');
                }
            }
        });
        
        // Scroll down button
        $('.scroll-down-btn').on('click', function() {
            $('html, body').animate({
                scrollTop: $('.press-section').offset().top - 80
            }, 800, 'easeInOutCubic');
        });
    }
    
    /**
     * Header Scroll Effect - Transparent to Black
     */
    function initHeaderScrollEffect() {
        const header = $('.site-header');
        let lastScrollTop = 0;
        let ticking = false;
        
        function updateHeader() {
            const currentScroll = $(window).scrollTop();
            
            // Change header background from transparent to black
            if (currentScroll > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
            
            // Subtle hide/show behavior on fast scroll
            if (currentScroll > lastScrollTop && currentScroll > 200) {
                // Scrolling down fast - slight hide
                header.css({
                    'transform': 'translateY(-5px)',
                    'opacity': '0.98'
                });
            } else {
                // Scrolling up or slow - show fully
                header.css({
                    'transform': 'translateY(0)',
                    'opacity': '1'
                });
            }
            
            lastScrollTop = currentScroll;
            ticking = false;
        }
        
        $(window).on('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        });
    }
    
    /**
     * Video Controls
     */
    function initVideoControls() {
        $('.video-play-pause').on('click', function() {
            const video = $(this).closest('.story-video-container').find('video')[0];
            const playIcon = $(this).find('.play-icon');
            const pauseIcon = $(this).find('.pause-icon');
            
            if (video.paused) {
                video.play();
                playIcon.hide();
                pauseIcon.show();
            } else {
                video.pause();
                playIcon.show();
                pauseIcon.hide();
            }
        });
        
        // Auto-hide controls after video starts
        $('video').on('play', function() {
            const controls = $(this).siblings('.video-controls');
            setTimeout(function() {
                controls.fadeOut();
            }, 2000);
        });
        
        $('video').on('pause', function() {
            $(this).siblings('.video-controls').fadeIn();
        });
    }
    
    /**
     * Store Locator Functionality
     */
    function initStoreLocator() {
        const searchForm = $('#store-search-form');
        const locationInput = $('#location-input');
        const quickLinks = $('.quick-link');
        const resultsContainer = $('#store-results');
        
        // Load store data
        let storeData = {};
        try {
            storeData = JSON.parse($('#store-locator-data').text());
        } catch (e) {
            console.warn('Store locator data not found');
            return;
        }
        
        // Handle form submission
        searchForm.on('submit', function(e) {
            e.preventDefault();
            const location = locationInput.val().trim();
            if (location) {
                searchStores(location);
            }
        });
        
        // Handle quick links
        quickLinks.on('click', function() {
            const location = $(this).data('location');
            locationInput.val(location);
            searchStores(location);
        });
        
        function searchStores(location) {
            // Simulate search (in real implementation, this would call an API)
            const stores = storeData.stores || [];
            displayStoreResults(stores, location);
        }
        
        function displayStoreResults(stores, searchLocation) {
            const resultsList = resultsContainer.find('.results-list');
            const resultsCount = resultsContainer.find('.results-count');
            
            resultsList.empty();
            resultsCount.text(`${stores.length} stores found near "${searchLocation}"`);
            
            stores.forEach(function(store) {
                const storeHtml = `
                    <div class="store-result">
                        <h4 class="store-name">${store.name}</h4>
                        <p class="store-address">${store.address}</p>
                        <p class="store-hours">${store.hours}</p>
                        <div class="store-actions">
                            <a href="tel:${store.phone}" class="btn btn--outline btn--small">Call</a>
                            <a href="https://maps.google.com/?q=${encodeURIComponent(store.address)}" 
                               target="_blank" class="btn btn--primary btn--small">Directions</a>
                        </div>
                    </div>
                `;
                resultsList.append(storeHtml);
            });
            
            resultsContainer.show();
        }
    }
    
    /**
     * Terpene Wheel Animation
     */
    function initTerpeneWheel() {
        const wheel = $('.terpene-wheel');
        const segments = wheel.find('.wheel-segment');
        
        // Add hover effects
        segments.on('mouseenter', function() {
            const terpene = $(this).data('terpene');
            $(this).css('transform', 'scale(1.1)');
            
            // Show terpene info (could expand this)
            console.log('Terpene:', terpene);
        });
        
        segments.on('mouseleave', function() {
            $(this).css('transform', 'scale(1)');
        });
        
        // Pause rotation on hover
        wheel.hover(
            function() {
                $(this).css('animation-play-state', 'paused');
            },
            function() {
                $(this).css('animation-play-state', 'running');
            }
        );
    }
    
    /**
     * Parallax Effects
     */
    function initParallaxEffects() {
        if (window.innerWidth < 768) return; // Disable on mobile for performance
        
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();
            const rate = scrolled * -0.5;
            
            // Hero parallax
            $('.hero-media').css('transform', `translateY(${rate}px)`);
            
            // Story section parallax
            $('.story-video-container').css('transform', `translateY(${rate * 0.3}px)`);
        });
    }
    
    /**
     * Hamburger Menu - Jeeter Style Full Screen
     */
    function initMobileMenu() {
        const hamburgerToggle = $('.hamburger-toggle');
        const menuOverlay = $('.menu-overlay');
        const searchToggle = $('.search-toggle');
        
        // Toggle hamburger menu
        hamburgerToggle.on('click', function() {
            $(this).toggleClass('active');
            menuOverlay.toggleClass('active');
            $('body').toggleClass('menu-open');
            
            // Prevent scroll when menu is open
            if (menuOverlay.hasClass('active')) {
                $('body').css('overflow', 'hidden');
            } else {
                $('body').css('overflow', '');
            }
        });
        
        // Close menu on nav link click
        $('.nav-menu.mobile-nav a').on('click', function() {
            hamburgerToggle.removeClass('active');
            menuOverlay.removeClass('active');
            $('body').removeClass('menu-open').css('overflow', '');
        });
        
        // Search toggle functionality
        searchToggle.on('click', function() {
            if (!menuOverlay.hasClass('active')) {
                hamburgerToggle.trigger('click');
            }
            // Focus search input after menu opens
            setTimeout(function() {
                $('.search-input').focus();
            }, 300);
        });
        
        // Close menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && menuOverlay.hasClass('active')) {
                hamburgerToggle.removeClass('active');
                menuOverlay.removeClass('active');
                $('body').removeClass('menu-open').css('overflow', '');
            }
        });
        
        // Handle search form submission
        $('.search-form').on('submit', function(e) {
            e.preventDefault();
            const query = $('.search-input').val().trim();
            if (query) {
                // In a real implementation, this would perform the search
                console.log('Searching for:', query);
                // For now, just close the menu
                hamburgerToggle.removeClass('active');
                menuOverlay.removeClass('active');
                $('body').removeClass('menu-open').css('overflow', '');
            }
        });
    }
    
    /**
     * Intersection Observer for Animations
     */
    function initScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            // Observe elements
            $('.product-category, .interactive-feature, .press-logo-item').each(function() {
                observer.observe(this);
            });
        }
    }
    
    /**
     * Initialize Map (placeholder for actual map integration)
     */
    window.initStoreLocatorMap = function() {
        const mapContainer = $('#store-locator-map');
        const placeholder = mapContainer.find('.map-placeholder');
        
        // This would integrate with Mapbox or Google Maps
        placeholder.html('<p>Map integration would go here...</p>');
        
        // Example: Initialize Mapbox
        // if (typeof mapboxgl !== 'undefined') {
        //     const map = new mapboxgl.Map({
        //         container: 'store-locator-map',
        //         style: 'mapbox://styles/mapbox/light-v10',
        //         center: [-75.5268, 42.9538], // NY center
        //         zoom: 7
        //     });
        // }
    };
    
    // Initialize animations
    initScrollAnimations();
    
    // Custom easing function
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };
    
})(jQuery);