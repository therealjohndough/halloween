# Skyworld Cannabis WordPress Theme - Deployment Guide

## 🚀 Quick Start

This theme is now **plug-and-play ready** for WordPress deployment with your real product and strain data.

## 📦 What's Included

### Core Theme Files
- **Complete WordPress theme** with Jeeter-inspired hamburger navigation
- **Hub-and-spoke architecture** (strains as hubs, products as spokes)
- **Mobile-first responsive design** with Skyworld branding
- **Age gate compliance** and NY Cannabis regulations
- **COA integration** with PDF download system

### Data Import System
- **CSV processors** for your existing WordPress exports
- **Automatic relationship building** between strains and products
- **Image import system** with WordPress media library integration
- **Store locator integration** for Agile Store Locator plugin

### Template Files
- `archive-strain.php` - Strain listings with filtering
- `single-strain.php` - Individual strain pages (hubs)
- `archive-cannabis_product.php` - Product listings with search
- `single-cannabis_product.php` - Product pages with lab results
- All existing homepage sections preserved

## 🛠️ Installation Steps

### 1. Upload Theme
```bash
# Upload wp-content/themes/skyworld-cannabis/ to your WordPress site
```

### 2. Install Required Plugins
- **Advanced Custom Fields (ACF)** - For product/strain fields
- **Agile Store Locator** (optional) - For enhanced store locator

### 3. Prepare Your Data
```bash
# Copy your CSV files to the WordPress uploads directory
cp "Cannabis-Products-Export-*.csv" wp-content/uploads/skyworld-source/products-export.csv
cp "Strains-Export-*.csv" wp-content/uploads/skyworld-source/strains-export.csv
```

### 4. Run Data Import
```bash
# Via WP-CLI (recommended)
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/csv-processor.php
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php

# Or run the automated script
./wp-content/themes/skyworld-cannabis/import-scripts/run-import.sh
```

### 5. Import Images
```bash
# Place product/strain images in wp-content/uploads/skyworld-images/
# Then run the image processor
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/image-manager.php
```

### 6. Setup Store Locator
```bash
# Store locations are managed via Agile Store Locator plugin
# No import needed - configure stores directly in WordPress admin
```

## 📊 Data Structure

### Strains (Hubs)
- **Post Type**: `strain`
- **Fields**: genetics, breeder, flowering_time, aroma_profile, flavor_profile
- **Taxonomies**: strain_type (Indica/Sativa/Hybrid)
- **Relationships**: Connected to multiple products

### Products (Spokes)
- **Post Type**: `cannabis_product`
- **Fields**: batch_number, cannabinoid percentages, terpene data
- **Taxonomies**: product_type (Flower/Pre-roll), strain_type
- **Relationships**: Connected to parent strain

### Hub-and-Spoke Model
```
Strain (Hub) ←→ Multiple Products (Spokes)
     ↓
Store Locator (Conversion Goal)
```

## 🎨 Design Features

### Navigation
- **Jeeter-inspired hamburger menu** on all devices
- **Full-screen overlay** with search functionality
- **Transparent-to-black header** behavior on scroll
- **NY State outline** in menu locations section

### Homepage Sections
1. **Hero Section** - Video background with Skyworld branding
2. **Press Section** - Media logos and coverage
3. **Product Categories** - Flower, Pre-rolls, etc.
4. **Story Section** - Brand narrative
5. **Interactive Section** - Terpene wheel
6. **Store Locator** - Primary conversion goal

### Brand Colors
- **Skyworld Orange**: `#f15b27`
- **Skyworld Blue**: `#54a5db`
- **Typography**: Montserrat font family

## 🔧 Customization

### Adding New Retailers
Configure store locations using the Agile Store Locator admin panel in WordPress.

### COA Management
Place PDF files in `/assets/coas/` named by batch number (e.g., `SW3725J-SP.pdf`).

### Image Organization
```
wp-content/uploads/skyworld-images/
├── strains/     # Strain hero images
├── products/    # Product photos
└── general/     # Other assets
```

## 🧪 Testing

### Local Development
```bash
# Start local server for testing
cd /path/to/your/wordpress
php -S localhost:8080
```

### Validation
- ✅ All product/strain relationships created
- ✅ Images properly imported to media library
- ✅ Store locator displaying NY retailers
- ✅ COA files accessible via batch numbers
- ✅ Age gate compliance active
- ✅ Mobile-responsive navigation working

## 📋 Content Migration Checklist

- [ ] Upload theme files
- [ ] Install ACF plugin
- [ ] Process CSV data files
- [ ] Import product/strain images
- [ ] Configure store locator
- [ ] Test age gate functionality
- [ ] Verify COA downloads
- [ ] Check mobile navigation
- [ ] Test hub-and-spoke relationships
- [ ] Validate store locator functionality

## 🛡️ Security & Compliance

### NY Cannabis Compliance
- Age gate enforcement (21+)
- Medical disclaimers included
- COA integration for transparency
- No e-commerce functionality (compliance-safe)

### WordPress Security
- All inputs sanitized and escaped
- Nonces on forms
- Prepared SQL statements
- User capability checks

## 📞 Support

This theme is designed to work with your existing data structure. All import scripts are compatible with your WordPress export format and will maintain proper relationships between strains and products.

**Key Benefits:**
- ✅ **Plug-and-play ready**
- ✅ **Uses your real data**
- ✅ **Hub-and-spoke architecture**
- ✅ **NY Cannabis compliant**
- ✅ **Mobile-first design**
- ✅ **Conversion optimized**

Ready for immediate deployment! 🚀