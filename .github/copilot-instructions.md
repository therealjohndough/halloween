# SkyWorld Cannabis WordPress Theme - AI Agent Instructions

## Architecture & Data Model

### Hub-and-Spoke Content Model
```
Strain (Hub) ←→ Products (Spokes) → Store Locator (Conversion)
```
- **Strains CPT**: `strains` - premium genetics information, cultivation details
- **Products CPT**: `products` - specific batch-based products linked to strains
- **Product Categories**: Only 3 types: Flower (3.5g), Pre-roll (various packs), Hash Hole (1g)
- **Naming Convention**: Products use "Strain + Category + Size" format (e.g., "Stay Puft Pre-roll 0.5g, 2pk")

### Core WordPress Integration
- **Theme Location**: `wp-content/themes/skyworld-cannabis/`
- **Custom Post Types**: Registered in `functions.php` with proper capabilities
- **ACF Dependencies**: Critical - all metadata stored as ACF fields
- **Taxonomies**: `strain_type` (Indica/Sativa/Hybrid), `product_type`, `effects`

## Data Sources & Import Workflow

### Authentic Skyworld Data Only
**Real strains** (never fabricate): Stay Puft, Garlic Gravity, Sherb Cream Pie, Skyworld Wafflez, Dirt n Worms, White Apple Runtz, 41 G, Melted Strawberries, Triple Burger, Charmz, Superboof, Stay Melo, Gushcanna, Lemon Oreoz, Peanut Butter Gelato, Kept Secret

### Import System Architecture
- **CSV Processors**: `import-scripts/skyworld-importer.php` handles strain→product relationships
- **Batch Numbers**: Primary identifiers (format: SW051925-HH-SPXPR) - critical for COA mapping
- **COA Integration**: PDFs in `assets/coas/` named by batch number
- **Data Flow**: CSV → ACF fields → Template display → Store locator conversion

### Development Commands
```bash
# Local development server
cd /path/to/wordpress && php -S localhost:8080

# Import data (requires WP-CLI)
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/skyworld-importer.php

# Validate ACF fields
wp eval-file wp-content/themes/skyworld-cannabis/import-scripts/wp-cli-import.php
```

## Theme Architecture

### Template Hierarchy
- `archive-products.php` / `archive-strains.php` - Professional listing pages with filtering
- `single-products.php` / `single-strains.php` - Individual product/strain pages
- `template-parts/product-categories.php` - Homepage product grid (Flower/Pre-roll/Hash Hole)
- Hub pages link to related spokes via ACF relationship fields

### Critical ACF Fields
```php
// Products
'batch_number' => 'SW051925-HH-SPXPR', // COA mapping key
'strain_name' => 'Stay Puft',          // Hub relationship
'thc_percent' => 25.9,                 // Display priority
'product_type' => 'Hash Hole',         // Category taxonomy

// Strains  
'genetics' => 'Ice Cream Cake x Sherb BX1',
'terpene_profile' => 'Myrcene 0.74; Linalool 0.52',
'strain_description' => '...'           // Hub content
```

### Styling & Brand
- **Primary Color**: `#F15B27` (Skyworld Orange)
- **Typography**: SkyFont family integrated via `@font-face`
- **Mobile-first**: Responsive breakpoints in `assets/css/main.css`
- **Professional Templates**: Converted from user's HTML designs, not basic alternatives

## Cannabis Compliance & Business Rules

### NY State Requirements
- Age gate enforcement (21+)
- COA accessibility (secondary placement)
- No medical claims or e-commerce functionality
- NYS OCM license display: "OCM-PROC-24-000030 | OCM-CULT-2023-000179"

### Conversion Strategy
All product/strain CTAs direct to store locator - never cart or purchase flows. Agile Store Locator plugin manages retailer locations.

## Development Patterns

### Security (WordPress-specific)
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

### Performance Priorities
- Lazy load product images in archives
- Preconnect to font sources
- Defer non-critical JS
- Target Lighthouse 90+ mobile score

### Import Script Patterns
- Check existing posts before creating: `get_page_by_title($title, OBJECT, 'products')`
- Build strain-to-product relationships via ACF: `update_field('related_strain', $strain_id, $product_id)`
- Process terpene JSON: `json_decode($terpene_data, true)`

## Common Debugging

### ACF Field Issues
```php
// Verify ACF availability
if (!function_exists('get_field')) {
    wp_die('ACF plugin required');
}

// Debug field values
var_dump(get_field('batch_number', $post_id));
```

### Import Troubleshooting
- **Strain relationships**: Verify strain exists before linking products
- **Batch numbers**: Must match COA filename format exactly
- **Product naming**: Follow "Strain + Category + Size" strictly

## File Organization
```
wp-content/themes/skyworld-cannabis/
├── functions.php           # CPT registration, ACF fields
├── assets/css/main.css     # Professional styling, SkyFont integration  
├── import-scripts/         # CSV processors, relationship builders
├── single-products.php     # Converted from user's HTML template
├── archive-products.php    # Professional listing with filtering
└── includes/coa-mapping.php # Batch→COA file associations
```