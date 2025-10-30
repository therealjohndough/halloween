#!/bin/bash

# Run complete Skyworld import process

echo "=== Running Skyworld Cannabis Import ==="
echo ""

# Check if we're in WordPress root
if [ ! -f "wp-config.php" ]; then
    echo "❌ Error: Please run this script from your WordPress root directory"
    exit 1
fi

# Check if WP-CLI is available
if ! command -v wp &> /dev/null; then
    echo "❌ Error: WP-CLI is not installed or not in PATH"
    echo "   Please install WP-CLI: https://wp-cli.org/"
    exit 1
fi

# Step 1: Process CSV files
echo "Step 1: Processing CSV files..."
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/csv-processor.php

if [ $? -ne 0 ]; then
    echo "❌ CSV processing failed"
    exit 1
fi

echo ""

# Step 2: Run import
echo "Step 2: Importing data..."
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php

if [ $? -ne 0 ]; then
    echo "❌ Import failed"
    exit 1
fi

echo ""
echo "✅ Import completed successfully!"
echo ""
echo "Next steps:"
echo "- Check your WordPress admin for imported strains and products"
echo "- Upload product/strain images to wp-content/uploads/"
echo "- Configure your store locator data"
echo "- Test the frontend display"