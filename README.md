# Skyworld Cannabis WordPress Theme

Professional WordPress theme for Skyworld Cannabis featuring a comprehensive design system, cannabis-specific components, and complete product management.

## 🎨 Design System

### Mast Framework-Inspired Architecture
Built on a complete design system inspired by Mast Framework principles with cannabis industry customizations:

- **Utility-first CSS** with `u-` prefixed classes
- **Design tokens** via CSS custom properties
- **Professional typography scale** (fs-xs to fs-6xl)
- **Systematic spacing** and responsive grid
- **Cannabis-specific components** and color modes

### Brand Colors
- **Primary Orange**: `#FF8C00` (Skyworld brand color)
- **Backgrounds**: Pure black `#000000` for ultra-clean aesthetic
- **Greys**: Sophisticated neutral palette
- **Cannabis Accents**: Industry-appropriate greens, purples, and golds

### Color Modes
```css
.u-mode-base          /* Default dark theme */
.u-mode-invert        /* Light theme */
.u-mode-accent1       /* Orange accent theme */
.u-mode-accent2       /* Cannabis green theme */
.u-mode-matte-black   /* Ultra-clean pure black outlines */
```

### Cannabis Components

### Strain & Product Elements
```css
.strain-name          /* Premium strain typography */
.strain-tag           /* Strain type indicators */
.strain-tag-glass     /* Glass morphism strain tags */
.effect-tag           /* Cannabis effect labels */
.cannabinoid-indicator /* THC/CBD displays */
.cannabinoid-indicator-glass /* Glass morphism THC/CBD */
.terpene-meter        /* Visual terpene profiles */
.terpene-meter-glass  /* Glass morphism terpene meters */
.lab-tested-badge     /* Compliance badges */
.lab-tested-badge-glass /* Glass morphism lab badges */
.premium-badge        /* Premium product markers */
```

### Glass Morphism System
```css
.u-glass              /* Basic glass morphism utility */
.u-glass-dark         /* Dark glass morphism */
.u-glass-orange       /* Orange tinted glass */
.u-glass-cannabis     /* Cannabis green tinted glass */
.u-glass-terpene      /* Terpene purple tinted glass */
.glass-card           /* Glass morphism cards */
.glass-button         /* Glass morphism buttons */
.product-card-glass   /* Enhanced glass product cards */
.navbar-glass         /* Glass morphism navigation */
```

### Usage Examples
```php
<!-- Premium glass morphism strain card -->
<div class="product-card-glass">
  <h2 class="strain-name">Stay Puft</h2>
  <span class="strain-tag-glass">Hybrid</span>
  <div class="cannabinoid-indicator-glass">
    <span class="cannabinoid-label">THC</span>
    <span class="cannabinoid-value">25.9%</span>
  </div>
  <span class="lab-tested-badge-glass">Lab Tested</span>
</div>

<!-- Matte black alternative -->
<div class="u-mode-matte-black u-p-lg">
  <h2 class="strain-name">Stay Puft</h2>
  <span class="strain-tag">Hybrid</span>
  <div class="cannabinoid-indicator">
    <span class="cannabinoid-label">THC</span>
    <span class="cannabinoid-value">25.9%</span>
  </div>
</div>

<!-- Glass morphism terpene profile -->
<div class="terpene-meter-glass">
  <span class="terpene-name">Myrcene</span>
  <div class="terpene-bar">
    <div class="terpene-fill" style="width: 74%"></div>
  </div>
  <span class="terpene-percentage">0.74%</span>
</div>
```

## 📁 Project Structure

```
wp-content/themes/skyworld-cannabis/
├── assets/
│   ├── css/
│   │   ├── design-system.css    # Complete design system
│   │   └── main.css             # Theme-specific styles
│   ├── js/                      # JavaScript functionality
│   └── images/                  # Optimized images
├── template-parts/              # Modular template components
├── import-scripts/              # Data import utilities
├── functions.php                # WordPress functionality
├── front-page.php              # Homepage template
├── page-about-ready.php        # Ready-to-use about page
├── page-store-locator-ready.php # Store locator template
├── page-careers-ready.php      # Careers page template
├── single-products.php         # Product detail pages
├── single-strains.php          # Strain detail pages
├── archive-products.php        # Product listings
└── archive-strains.php         # Strain listings
```

## 🗄️ Data Architecture

### Hub-and-Spoke Content Model
```
Strain (Hub) ←→ Products (Spokes) → Store Locator (Conversion)
```

### Custom Post Types
- **Strains CPT**: `strains` - premium genetics and cultivation info
- **Products CPT**: `products` - batch-based products linked to strains
- **Categories**: Flower (3.5g), Pre-roll (packs), Hash Hole (1g)

### ACF Field Structure
```php
// Products
'batch_number' => 'SW051925-HH-SPXPR', // COA mapping key
'strain_name' => 'Stay Puft',          // Hub relationship
'thc_percent' => 25.9,                 // Display priority
'product_type' => 'Hash Hole',         // Category taxonomy

// Strains  
'genetics' => 'Ice Cream Cake x Sherb BX1',
'terpene_profile' => 'Myrcene 0.74; Linalool 0.52',
'strain_description' => 'Premium cultivation details...'
```

## 🚀 Development Setup

### Local Development
```bash
# Start local WordPress server
cd /path/to/wordpress && php -S localhost:8080

# Import authentic Skyworld data
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php

# Validate ACF fields
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/wp-cli-import.php
```

### Authentic Strain Data
**Real strains only** (never fabricate): Stay Puft, Garlic Gravity, Sherb Cream Pie, Skyworld Wafflez, Dirt n Worms, White Apple Runtz, 41 G, Melted Strawberries, Triple Burger, Charmz, Superboof, Stay Melo, Gushcanna, Lemon Oreoz, Peanut Butter Gelato, Kept Secret

## 📋 Ready-to-Use Templates

### Page Templates
- **About Page**: Complete company story with founder bios
- **Store Locator**: Interactive dispensary finder with search
- **Careers**: Job listings with company culture section

### Usage
1. Create new page in WordPress admin
2. Select desired template from Page Attributes
3. Publish - content appears immediately with proper styling

## 🔒 Compliance Features

### NY State Requirements
- Age gate enforcement (21+)
- COA accessibility with batch number mapping
- No medical claims or e-commerce functionality
- NYS OCM license display: "OCM-PROC-24-000030 | OCM-CULT-2023-000179"

### Security Best Practices
```php
// Always escape output
echo esc_html($strain_name);
echo esc_attr($batch_number);

// Sanitize inputs
$thc = floatval($_POST['thc_percent']);
$strain = sanitize_text_field($_POST['strain_name']);

// ACF field updates
update_field('batch_number', sanitize_text_field($batch), $post_id);
```

## 🎯 Conversion Strategy

All product/strain CTAs direct to **store locator** - never cart/purchase flows. Agile Store Locator plugin manages 95+ retailer locations for seamless customer journey.

## 📱 Performance & SEO

### Technical Features
- **Mobile-first responsive design**
- **WebP image optimization**
- **Structured data markup**
- **Core Web Vitals optimization**
- **Lazy loading for product images**

### SEO Enhancements
- **Schema.org markup** for products and strains
- **Optimized meta descriptions**
- **Canonical URLs**
- **Social media Open Graph tags**

## 🛠️ Utilities & Classes

### Common Patterns
```css
/* Layout */
.container                    /* Max-width container */
.row, .col-*                 /* Grid system */
.u-d-flex, .u-d-block       /* Display utilities */

/* Spacing */
.u-mt-lg, .u-mb-md          /* Margin utilities */
.u-pt-sm, .u-pb-xl          /* Padding utilities */

/* Colors */
.u-bg-primary               /* Orange background */
.u-bg-secondary             /* Black background */
.u-text-primary             /* Orange text */
.u-text-white               /* White text */

/* Typography */
.h1, .h2, .h3               /* Heading classes */
.paragraph-lg, .paragraph-sm /* Text size variants */
.u-text-center             /* Text alignment */

/* Cannabis-specific */
.strain-name                /* Premium strain typography */
.thc-percentage             /* Cannabinoid display */
.effect-tag                 /* Effect indicators */
.terpene-meter             /* Terpene visualization */
```

## 📄 License & Usage

This theme is specifically designed for Skyworld Cannabis and includes:
- ✅ Authentic strain data and product relationships
- ✅ NY State cannabis compliance features
- ✅ Professional design system with industry customizations
- ✅ Complete import/export functionality
- ✅ Ready-to-deploy templates and components

---

**Built with WordPress best practices and cannabis industry expertise.**