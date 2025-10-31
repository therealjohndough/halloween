# Hero Slider Manual Setup Instructions

## Overview
The hero slider has been implemented and is ready to use. Here's how to populate it with content through WordPress admin or via script.

## Method 1: Automatic Setup (Recommended)

### Via WP-CLI (if available):
```bash
cd /path/to/your/wordpress/
./setup-hero-slider.sh
```

### Via WordPress Admin:
1. Go to **WordPress Admin > Tools > Site Health**
2. Click **Info** tab → **Server** section
3. Look for "PHP eval" or similar (varies by hosting)
4. Or contact your developer to run the populate script

## Method 2: Manual Setup via WordPress Admin

### Step 1: Install ACF Pro Plugin
- Download and install Advanced Custom Fields Pro
- Activate the plugin

### Step 2: Edit Homepage
1. Go to **Pages > All Pages**
2. Find your homepage (usually "Home" or front page set in Settings > Reading)
3. Click **Edit**

### Step 3: Configure Hero Slides
Look for the **Hero Slides** section in the page editor:

#### Slide 1 - Brand Introduction
- **Background Image:** Upload Stay Puft strain image
- **Headline:** `Premium New York Indoor Cannabis`
- **Subheadline:** `Rooted in Indigenous Tradition. Grown with intention. Crafted with respect.`
- **Primary CTA Text:** `Explore Our Flower`
- **Primary CTA URL:** `/strains/`
- **Secondary CTA Text:** `Find Skyworld Near You`
- **Secondary CTA URL:** `/store-locator/`

#### Slide 2 - Featured Strains
- **Background Image:** Upload Garlic Gravity strain image
- **Headline:** `Stay Puft & Garlic Gravity`
- **Subheadline:** `Featured Strains. Premium genetics meet expert cultivation for an unforgettable experience.`
- **Primary CTA Text:** `Shop Strains`
- **Primary CTA URL:** `/strains/`
- **Secondary CTA Text:** `Learn Our Process`
- **Secondary CTA URL:** `/our-story/`

#### Slide 3 - Store Locator
- **Background Image:** Upload Sherb Cream Pie strain image
- **Headline:** `Find Skyworld Near You`
- **Subheadline:** `95+ Store Locations. Your favorite Skyworld strains are closer than you think.`
- **Primary CTA Text:** `Store Locator`
- **Primary CTA URL:** `/store-locator/`
- **Secondary CTA Text:** `View All Products`
- **Secondary CTA URL:** `/products/`

### Step 4: Configure Press Marquee
Add these press logos to the marquee:
- High Times
- Cannabis Business Times
- Leafly
- MJBizDaily
- New York Cannabis Insider

## Customization Options

### Adding More Slides
- Click **Add Slide** in the Hero Slides section
- Follow the same format as the first 3 slides
- Recommended max: 5 slides for optimal user experience

### Changing Slide Timing
The slider auto-advances every 6 seconds by default. To change:
1. Edit `/assets/js/hero-slider.js`
2. Find `autoPlayDelay = 6000`
3. Change to desired milliseconds (5000 = 5 seconds)

### Customizing Colors/Styling
- Edit `/assets/css/hero-slider.css`
- Look for CSS custom properties at the top
- Modify colors, fonts, animations as needed

## Troubleshooting

### Slider Not Appearing
1. Check if ACF Pro is installed and activated
2. Verify hero slides have been added to the homepage
3. Check if hero-slider.css and hero-slider.js are loading
4. Clear any caching plugins

### Images Not Loading
1. Verify images are uploaded to WordPress Media Library
2. Check image file sizes (recommended: under 500KB each)
3. Ensure AVIF images are supported by your server

### Animation Issues
1. Check if JavaScript errors in browser console
2. Verify hero-slider.js is loading without conflicts
3. Test on different browsers and devices

## Performance Notes

- Hero images should be optimized (WebP/AVIF format preferred)
- Maximum recommended file size: 500KB per image
- Slider uses hardware acceleration for smooth transitions
- Marquee pauses on hover for better UX

## Compliance Notes

- All content follows NY State cannabis compliance
- No medical claims in slider copy
- Age-appropriate imagery and messaging
- COA links available but not prominently displayed

## Support

If you need assistance with setup:
1. Check the console for JavaScript errors
2. Verify all files are uploaded correctly
3. Test with different themes to isolate issues
4. Contact your developer for custom implementations