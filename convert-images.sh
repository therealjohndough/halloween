#!/bin/bash
# Convert Skyworld photos to WebP for web optimization

echo "🖼️ Converting Skyworld photos to WebP..."

# Create output directories
mkdir -p "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/team"
mkdir -p "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/cultivation"

# Convert team photos
echo "👥 Converting team photos..."
cd "/Users/dough/Downloads/02 Photos — Skyworld/01 Team"
find . -type f \( -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" \) | while read file; do
    filename=$(basename "$file")
    name="${filename%.*}"
    echo "Converting: $filename"
    
    # Convert to WebP with 85% quality
    if command -v cwebp >/dev/null 2>&1; then
        cwebp -q 85 "$file" -o "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/team/${name}.webp"
    else
        echo "⚠️ cwebp not found. Install with: brew install webp"
        # Alternative using sips (macOS built-in)
        sips -s format webp "$file" --out "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/team/${name}.webp"
    fi
done

# Convert cultivation photos
echo "🌱 Converting cultivation photos..."
cd "/Users/dough/Downloads/02 Photos — Skyworld/03 Cultivation Facility"
find . -type f \( -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" \) | while read file; do
    filename=$(basename "$file")
    name="${filename%.*}"
    echo "Converting: $filename"
    
    if command -v cwebp >/dev/null 2>&1; then
        cwebp -q 85 "$file" -o "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/cultivation/${name}.webp"
    else
        sips -s format webp "$file" --out "/Users/dough/VS Studio Projects/oct30-sw/wp-content/themes/skyworld-cannabis/assets/images/cultivation/${name}.webp"
    fi
done

echo "✅ Photo conversion complete!"
echo "📁 Team photos: /wp-content/themes/skyworld-cannabis/assets/images/team/"
echo "📁 Cultivation photos: /wp-content/themes/skyworld-cannabis/assets/images/cultivation/"