/**
 * Skyworld Cannabis - Hero Slider JavaScript
 * ACF-powered hero slider with smooth transitions and press marquee
 */

class SkyWorldHeroSlider {
    constructor() {
        this.currentSlide = 0;
        this.slides = [];
        this.slideCount = 0;
        this.autoPlayInterval = null;
        this.autoPlayDelay = 6000; // 6 seconds per slide
        this.isTransitioning = false;
        
        this.init();
    }
    
    init() {
        this.cacheElements();
        this.setupSlides();
        this.bindEvents();
        this.startAutoPlay();
        this.initializePressMarquee();
        
        // Show first slide
        if (this.slideCount > 0) {
            this.showSlide(0, false);
        }
        
        console.log('SkyWorld Hero Slider initialized with', this.slideCount, 'slides');
    }
    
    cacheElements() {
        this.sliderContainer = document.querySelector('.hero-slider');
        this.slidesContainer = document.querySelector('.hero-slides-container');
        this.slides = Array.from(document.querySelectorAll('.hero-slide'));
        this.dots = Array.from(document.querySelectorAll('.hero-dot'));
        this.prevButton = document.querySelector('.hero-arrow.prev');
        this.nextButton = document.querySelector('.hero-arrow.next');
        this.slideCount = this.slides.length;
    }
    
    setupSlides() {
        // Hide all slides initially
        this.slides.forEach((slide, index) => {
            slide.style.opacity = '0';
            slide.classList.remove('active');
        });
        
        // Update dots
        this.updateDots();
    }
    
    bindEvents() {
        // Dot navigation
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                if (!this.isTransitioning) {
                    this.goToSlide(index);
                }
            });
        });
        
        // Arrow navigation
        if (this.prevButton) {
            this.prevButton.addEventListener('click', () => {
                if (!this.isTransitioning) {
                    this.prevSlide();
                }
            });
        }
        
        if (this.nextButton) {
            this.nextButton.addEventListener('click', () => {
                if (!this.isTransitioning) {
                    this.nextSlide();
                }
            });
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.isTransitioning) {
                switch(e.key) {
                    case 'ArrowLeft':
                        this.prevSlide();
                        break;
                    case 'ArrowRight':
                        this.nextSlide();
                        break;
                    case ' ': // Spacebar
                        e.preventDefault();
                        this.toggleAutoPlay();
                        break;
                }
            }
        });
        
        // Pause on hover
        if (this.sliderContainer) {
            this.sliderContainer.addEventListener('mouseenter', () => {
                this.pauseAutoPlay();
            });
            
            this.sliderContainer.addEventListener('mouseleave', () => {
                this.startAutoPlay();
            });
        }
        
        // Touch/swipe support
        this.setupTouchEvents();
        
        // Visibility API - pause when tab is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseAutoPlay();
            } else {
                this.startAutoPlay();
            }
        });
    }
    
    setupTouchEvents() {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;
        
        if (this.sliderContainer) {
            this.sliderContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            }, { passive: true });
            
            this.sliderContainer.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                endY = e.changedTouches[0].clientY;
                
                const deltaX = startX - endX;
                const deltaY = startY - endY;
                
                // Only handle horizontal swipes (ignore vertical scrolling)
                if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
                    if (!this.isTransitioning) {
                        if (deltaX > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                }
            }, { passive: true });
        }
    }
    
    showSlide(index, animate = true) {
        if (index < 0 || index >= this.slideCount || this.isTransitioning) {
            return;
        }
        
        this.isTransitioning = true;
        
        // Hide current slide
        const currentSlideElement = this.slides[this.currentSlide];
        if (currentSlideElement) {
            currentSlideElement.classList.remove('active');
            currentSlideElement.classList.add('exiting');
        }
        
        // Show new slide
        const newSlideElement = this.slides[index];
        if (newSlideElement) {
            // Small delay to ensure smooth transition
            setTimeout(() => {
                if (currentSlideElement) {
                    currentSlideElement.classList.remove('exiting');
                }
                
                newSlideElement.classList.add('active', 'entering');
                
                // Remove entering class after animation
                setTimeout(() => {
                    newSlideElement.classList.remove('entering');
                    this.isTransitioning = false;
                }, animate ? 1500 : 0);
                
            }, animate ? 100 : 0);
        }
        
        this.currentSlide = index;
        this.updateDots();
        
        // Trigger custom event
        this.sliderContainer?.dispatchEvent(new CustomEvent('slideChange', {
            detail: { currentSlide: this.currentSlide }
        }));
    }
    
    nextSlide() {
        const nextIndex = (this.currentSlide + 1) % this.slideCount;
        this.goToSlide(nextIndex);
    }
    
    prevSlide() {
        const prevIndex = (this.currentSlide - 1 + this.slideCount) % this.slideCount;
        this.goToSlide(prevIndex);
    }
    
    goToSlide(index) {
        this.pauseAutoPlay();
        this.showSlide(index);
        
        // Restart autoplay after user interaction
        setTimeout(() => {
            this.startAutoPlay();
        }, 2000);
    }
    
    updateDots() {
        this.dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
        });
    }
    
    startAutoPlay() {
        this.pauseAutoPlay(); // Clear any existing interval
        
        if (this.slideCount > 1) {
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, this.autoPlayDelay);
        }
    }
    
    pauseAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }
    
    toggleAutoPlay() {
        if (this.autoPlayInterval) {
            this.pauseAutoPlay();
        } else {
            this.startAutoPlay();
        }
    }
    
    initializePressMarquee() {
        const marqueeTrack = document.querySelector('.press-marquee-track');
        if (!marqueeTrack) return;
        
        // Clone the marquee content for seamless looping
        const marqueeContent = marqueeTrack.innerHTML;
        marqueeTrack.innerHTML = marqueeContent + marqueeContent;
        
        // Add hover pause functionality to marquee
        const marqueeContainer = document.querySelector('.press-marquee');
        if (marqueeContainer) {
            marqueeContainer.addEventListener('mouseenter', () => {
                marqueeTrack.style.animationPlayState = 'paused';
            });
            
            marqueeContainer.addEventListener('mouseleave', () => {
                marqueeTrack.style.animationPlayState = 'running';
            });
        }
    }
    
    // Public API methods
    destroy() {
        this.pauseAutoPlay();
        // Remove event listeners
        document.removeEventListener('keydown', this.handleKeydown);
        document.removeEventListener('visibilitychange', this.handleVisibilityChange);
    }
    
    getCurrentSlide() {
        return this.currentSlide;
    }
    
    getSlideCount() {
        return this.slideCount;
    }
}

// Cannabis Leaf SVG Animation
class CannabisLeafAnimation {
    constructor() {
        this.leafElements = document.querySelectorAll('.cannabis-leaf-svg');
        this.init();
    }
    
    init() {
        this.leafElements.forEach((leaf, index) => {
            // Stagger animation delays
            leaf.style.animationDelay = `${index * 0.5}s`;
            
            // Add hover interaction
            leaf.addEventListener('mouseenter', () => {
                leaf.style.animationPlayState = 'paused';
                leaf.style.transform = 'scale(1.2) rotate(10deg)';
            });
            
            leaf.addEventListener('mouseleave', () => {
                leaf.style.animationPlayState = 'running';
                leaf.style.transform = '';
            });
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Check if hero slider exists on page
    if (document.querySelector('.hero-slider')) {
        window.skyWorldHeroSlider = new SkyWorldHeroSlider();
        window.cannabisLeafAnimation = new CannabisLeafAnimation();
        
        // Debug mode - uncomment for development
        // console.log('SkyWorld Hero Slider loaded:', window.skyWorldHeroSlider);
    }
});

// Preload images for smooth transitions
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    slides.forEach(slide => {
        const bgImage = slide.style.backgroundImage;
        if (bgImage) {
            const imageUrl = bgImage.slice(4, -1).replace(/"/g, "");
            const img = new Image();
            img.src = imageUrl;
        }
    });
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { SkyWorldHeroSlider, CannabisLeafAnimation };
}