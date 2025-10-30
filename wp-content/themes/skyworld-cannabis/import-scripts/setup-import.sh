#!/bin/bash

# Skyworld Cannabis Import Setup Script
# This script copies your CSV files and runs the WordPress import

echo "=== Skyworld Cannabis Import Setup ==="
echo ""

# Get WordPress root directory
WP_ROOT=$(pwd)
UPLOAD_DIR="$WP_ROOT/wp-content/uploads"
SOURCE_DIR="$UPLOAD_DIR/skyworld-source"
IMPORT_DIR="$UPLOAD_DIR/skyworld-import"

# Create directories
echo "Creating directories..."
mkdir -p "$SOURCE_DIR"
mkdir -p "$IMPORT_DIR"

echo "Upload directories created:"
echo "Source: $SOURCE_DIR"
echo "Import: $IMPORT_DIR"
echo ""

# Check for CSV files in current directory
STRAINS_FILE=""
PRODUCTS_FILE=""
INVENTORY_FILE=""

# Look for strain files
if [ -f "Strains-Export-*.csv" ]; then
    STRAINS_FILE=$(ls Strains-Export-*.csv | head -n1)
elif [ -f "skyworld-strains-library-import.csv" ]; then
    STRAINS_FILE="skyworld-strains-library-import.csv"
fi

# Look for product files  
if [ -f "Cannabis-Products-Export-*.csv" ]; then
    PRODUCTS_FILE=$(ls Cannabis-Products-Export-*.csv | head -n1)
elif [ -f "skyworld-product-inventory-master.csv" ]; then
    PRODUCTS_FILE="skyworld-product-inventory-master.csv"
fi

# Copy files if found
if [ -n "$STRAINS_FILE" ]; then
    echo "Copying strains file: $STRAINS_FILE"
    cp "$STRAINS_FILE" "$SOURCE_DIR/strains-export.csv"
else
    echo "⚠️  No strains CSV file found"
    echo "   Please copy your strains file to: $SOURCE_DIR/strains-export.csv"
fi

if [ -n "$PRODUCTS_FILE" ]; then
    echo "Copying products file: $PRODUCTS_FILE"
    cp "$PRODUCTS_FILE" "$SOURCE_DIR/products-export.csv"
else
    echo "⚠️  No products CSV file found"
    echo "   Please copy your products file to: $SOURCE_DIR/products-export.csv"
fi

echo ""
echo "=== Next Steps ==="
echo ""
echo "1. Process CSV files:"
echo "   wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/csv-processor.php"
echo ""
echo "2. Run the import:"
echo "   wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php"
echo ""
echo "3. Or run both in sequence:"
echo "   ./wp-content/themes/skyworld-cannabis/import-scripts/run-import.sh"
echo ""

# Make run-import.sh executable
chmod +x "$WP_ROOT/wp-content/themes/skyworld-cannabis/import-scripts/run-import.sh"

echo "Setup complete! 🚀"