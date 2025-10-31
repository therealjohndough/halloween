#!/bin/bash

# Skyworld CPT System Installer
# Installs Custom Post Types and ACF fields on any WordPress site

echo "🌿 Skyworld Cannabis - CPT System Installer"
echo "==========================================="

# Check if we're in a WordPress directory
if [ ! -f wp-config.php ]; then
    echo "❌ wp-config.php not found. Please run this from your WordPress root directory."
    exit 1
fi

# Check if ACF Pro is installed
echo "🔍 Checking for ACF Pro plugin..."
if wp plugin is-installed advanced-custom-fields-pro; then
    echo "✅ ACF Pro found"
    
    if ! wp plugin is-active advanced-custom-fields-pro; then
        echo "🔧 Activating ACF Pro..."
        wp plugin activate advanced-custom-fields-pro
    fi
else
    echo "❌ ACF Pro not found. Please install ACF Pro first."
    echo "   You can download it from: https://www.advancedcustomfields.com/pro/"
    exit 1
fi

# Check if WP-CLI is available
if ! command -v wp &> /dev/null; then
    echo "❌ WP-CLI not found. Please install WP-CLI first."
    echo "   Installation guide: https://wp-cli.org/#installing"
    exit 1
fi

echo ""
echo "🚀 Installing Skyworld CPT System..."

# Run the CPT system installer
if [ -f skyworld-cpt-system.php ]; then
    wp eval-file skyworld-cpt-system.php
    
    if [ $? -eq 0 ]; then
        echo ""
        echo "✅ Installation complete!"
        echo ""
        echo "📋 What was installed:"
        echo "  • Strains Custom Post Type"
        echo "  • Products Custom Post Type"
        echo "  • Strain Types taxonomy (Indica/Sativa/Hybrid)"
        echo "  • Product Types taxonomy (Flower/Pre-roll/Hash Hole)"
        echo "  • Effects taxonomy"
        echo "  • Complete ACF field groups for both CPTs"
        echo ""
        echo "👉 Next steps:"
        echo "  1. Go to WordPress Admin > Strains"
        echo "  2. Go to WordPress Admin > Products"
        echo "  3. Start adding your strain and product data"
        echo ""
        echo "📖 Need to import data? Use the CSV import scripts:"
        echo "  • skyworld-strains-import.php"
        echo "  • skyworld-products-import.php"
    else
        echo "❌ Installation failed. Check the error messages above."
        exit 1
    fi
else
    echo "❌ skyworld-cpt-system.php not found in current directory."
    echo "   Please make sure the file is in your WordPress root directory."
    exit 1
fi