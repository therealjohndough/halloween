#!/bin/bash

# Hero Slider Population Script for Skyworld Cannabis
# Runs the hero slider population via WP-CLI

echo "🎯 Skyworld Cannabis - Hero Slider Setup"
echo "========================================="

# Check if WP-CLI is available
if ! command -v wp &> /dev/null; then
    echo "❌ WP-CLI not found. Please install WP-CLI or run this manually in WordPress admin."
    echo "📖 Alternative: Copy populate-hero-slides.php content to WordPress admin > Tools > Site Health > Info > Debug Info"
    exit 1
fi

# Check if we're in a WordPress directory
if [ ! -f wp-config.php ]; then
    echo "❌ wp-config.php not found. Please run this from your WordPress root directory."
    exit 1
fi

echo "🔧 Running hero slider population script..."

# Run the population script via WP-CLI
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/populate-hero-slides.php

echo ""
echo "✅ Hero slider setup complete!"
echo "🌐 Visit your homepage to see the new Jeeter-inspired hero slider"
echo "📱 Test on mobile and desktop for responsive design"
echo ""
echo "Next steps:"
echo "1. Visit your homepage to verify the slider works"
echo "2. Add press logos to the marquee section"
echo "3. Customize slide content as needed via WordPress admin"