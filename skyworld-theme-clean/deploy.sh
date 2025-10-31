#!/bin/bash

# Skyworld Cannabis Theme - Complete Deployment Script
# Run this script to set up the complete theme with data import

echo "🚀 Skyworld Cannabis WordPress Theme Deployment"
echo "================================================"
echo ""

# Check if we're in WordPress root
if [ ! -f "wp-config.php" ]; then
    echo "❌ Error: Please run this script from your WordPress root directory"
    exit 1
fi

# Check if WP-CLI is available
if ! command -v wp &> /dev/null; then
    echo "⚠️  WP-CLI not found. Install from: https://wp-cli.org/"
    echo "   Continuing with manual steps..."
    USE_WPCLI=false
else
    USE_WPCLI=true
fi

echo "Step 1: Setting up directories..."
# Create necessary directories
mkdir -p wp-content/uploads/skyworld-source
mkdir -p wp-content/uploads/skyworld-import
mkdir -p wp-content/uploads/skyworld-images/strains
mkdir -p wp-content/uploads/skyworld-images/products

echo "✅ Directories created"
echo ""

echo "Step 2: Copying data files..."
# Look for and copy CSV files
STRAINS_FOUND=false
PRODUCTS_FOUND=false

# Look for strain files
for file in Strains-Export-*.csv skyworld-strains-library-import.csv; do
    if [ -f "$file" ]; then
        cp "$file" wp-content/uploads/skyworld-source/strains-export.csv
        echo "📄 Copied strains file: $file"
        STRAINS_FOUND=true
        break
    fi
done

# Look for product files
for file in Cannabis-Products-Export-*.csv skyworld-product-inventory-master.csv; do
    if [ -f "$file" ]; then
        cp "$file" wp-content/uploads/skyworld-source/products-export.csv
        echo "📄 Copied products file: $file"
        PRODUCTS_FOUND=true
        break
    fi
done

if [ "$STRAINS_FOUND" = false ]; then
    echo "⚠️  No strains CSV found. Please manually copy to:"
    echo "   wp-content/uploads/skyworld-source/strains-export.csv"
fi

if [ "$PRODUCTS_FOUND" = false ]; then
    echo "⚠️  No products CSV found. Please manually copy to:"
    echo "   wp-content/uploads/skyworld-source/products-export.csv"
fi

echo ""

if [ "$USE_WPCLI" = true ] && [ "$STRAINS_FOUND" = true ] && [ "$PRODUCTS_FOUND" = true ]; then
    echo "Step 3: Processing and importing data..."
    
    # Process CSV files
    echo "🔄 Processing CSV files..."
    wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/csv-processor.php
    
    if [ $? -eq 0 ]; then
        echo "✅ CSV processing complete"
        
        # Import data
        echo "🔄 Importing strains and products..."
        wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php
        
        if [ $? -eq 0 ]; then
            echo "✅ Data import complete"
        else
            echo "❌ Data import failed"
        fi
    else
        echo "❌ CSV processing failed"
    fi
    
    echo ""
    echo "Step 4: Setting up store locator..."
    wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/store-locator.php
    echo "✅ Store locator configured"
    
    echo ""
    echo "Step 5: Processing images..."
    wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/image-manager.php
    echo "✅ Image processing complete"
    
else
    echo "Step 3: Manual data import required"
    echo "Please run these commands when ready:"
    echo ""
    echo "# Process CSV files:"
    echo "wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/csv-processor.php"
    echo ""
    echo "# Import data:"
    echo "wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php"
    echo ""
    echo "# Setup store locator:"
    echo "wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/store-locator.php"
    echo ""
    echo "# Process images:"
    echo "wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/image-manager.php"
    echo ""
fi

echo ""
echo "🎉 Skyworld Cannabis Theme Deployment Complete!"
echo ""
echo "📋 Next Steps:"
echo "1. Activate the 'Skyworld Cannabis' theme in WordPress admin"
echo "2. Install and activate Advanced Custom Fields (ACF) plugin"
echo "3. Install Agile Store Locator plugin (optional, for enhanced maps)"
echo "4. Upload product/strain images to wp-content/uploads/skyworld-images/"
echo "5. Place COA PDFs in wp-content/themes/skyworld-cannabis/assets/coas/"
echo "6. Test the site functionality"
echo ""
echo "🔗 Key URLs to test:"
echo "- Homepage: /"
echo "- Strains: /strains/"
echo "- Products: /cannabis-products/"
echo "- Store Locator: /#store-locator"
echo ""
echo "📚 See README.md for detailed documentation"
echo ""
echo "🚀 Your theme is ready for production!"