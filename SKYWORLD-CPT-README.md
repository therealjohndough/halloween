# Skyworld Cannabis - Standalone CPT System

A complete, portable Custom Post Types system for cannabis businesses. Works on any WordPress site with ACF Pro.

## 🌿 What's Included

### Custom Post Types
- **Strains** - Cannabis strain information with genetics, effects, and lab data
- **Products** - Specific products linked to strains with batch tracking

### Taxonomies
- **Strain Types** - Indica, Sativa, Hybrid
- **Product Types** - Flower, Pre-roll, Hash Hole, etc.
- **Effects** - Relaxed, Creative, Focused, etc.

### ACF Field Groups
Complete field sets for both strains and products including:
- Genetics/lineage information
- THC/CBD percentages
- Terpene profiles
- Batch numbers for compliance
- Image galleries
- COA file uploads
- Strain-to-product relationships

## 📦 Installation

### Requirements
- WordPress 5.0+
- ACF Pro plugin
- WP-CLI (recommended)

### Quick Install
1. Upload files to your WordPress root directory
2. Run the installer:
```bash
./install-skyworld-cpts.sh
```

### Manual Install
```bash
# Install CPT system
wp eval-file skyworld-cpt-system.php

# Import data (optional)
wp eval-file skyworld-data-importer.php
```

## 📊 Data Import

### CSV Format - Strains
```csv
strain_name,genetics,description,thc_percent,cbd_percent,strain_type,terpenes,aroma_flavor
Stay Puft,Ice Cream Cake x Sherb BX1,Premium indoor strain,25.9,0.5,Hybrid,Myrcene 0.74; Linalool 0.52,Sweet and creamy
```

### CSV Format - Products
```csv
product_name,strain_name,batch_number,product_type,weight,thc_percent,cbd_percent,description
Stay Puft 3.5g,Stay Puft,SW051925-FL-SP,Flower,3.5g,25.9,0.5,Premium indoor flower
```

### Import Process
1. Place CSV files in same directory as scripts
2. Run: `wp eval-file skyworld-data-importer.php`
3. Check WordPress Admin > Strains and Products

## 🛠️ Files Overview

### Core System
- `skyworld-cpt-system.php` - Main CPT registration and ACF fields
- `install-skyworld-cpts.sh` - Automated installer script
- `skyworld-data-importer.php` - CSV data import system

### Features
- ✅ Complete ACF field definitions
- ✅ Proper WordPress integration
- ✅ Taxonomy management
- ✅ Data relationships (strain ↔ products)
- ✅ Cannabis industry compliance
- ✅ Batch number tracking
- ✅ COA file management
- ✅ Image gallery support

## 🎯 Usage

### Adding Strains
1. Go to **WordPress Admin > Strains > Add New**
2. Fill in strain information:
   - Name and genetics
   - THC/CBD percentages
   - Terpene profile
   - Description and effects
   - Upload strain photos
   - Attach COA file

### Adding Products
1. Go to **WordPress Admin > Products > Add New**
2. Fill in product details:
   - Product name and batch number
   - Link to related strain
   - Product type and weight
   - Specific THC/CBD for this batch
   - Upload product photos

### Managing Relationships
- Products automatically link to strains
- Strain pages show related products
- Taxonomy filtering for easy organization

## 🔧 Customization

### Adding Fields
Edit `skyworld-cpt-system.php` and add fields to the ACF field group arrays:

```php
array(
    'key' => 'field_new_field',
    'label' => 'New Field',
    'name' => 'new_field',
    'type' => 'text',
    'instructions' => 'Field description',
    'required' => 0,
),
```

### Custom Taxonomies
Add new taxonomies in the `register_taxonomies()` method:

```php
register_taxonomy('new_taxonomy', 'strains', array(
    'labels' => array('name' => 'New Categories'),
    'hierarchical' => true,
    'public' => true,
    'show_in_rest' => true,
));
```

## 🚀 Deployment

### For Theme Integration
Add to your theme's `functions.php`:
```php
include_once get_template_directory() . '/includes/skyworld-cpt-system.php';
```

### For Plugin Development
Wrap the code in a plugin header and install as a WordPress plugin.

### For Multiple Sites
Use the standalone files - they work on any WordPress installation with ACF Pro.

## 🔍 Troubleshooting

### CPTs Not Appearing
1. Check if ACF Pro is installed and activated
2. Flush rewrite rules: `wp rewrite flush`
3. Check for PHP errors in debug log

### Import Issues
1. Verify CSV format matches expected structure
2. Check file permissions
3. Ensure strain names exist before importing products

### Field Issues
1. Verify ACF Pro is active
2. Check field group keys are unique
3. Test with a simple field first

## 📝 License & Support

This system is designed for Skyworld Cannabis but can be adapted for any cannabis business. 

### Compliance Notes
- Designed for New York State regulations
- Includes batch tracking for traceability
- COA file management for lab compliance
- No medical claims in default content

### Support
- Check WordPress debug logs for errors
- Verify ACF Pro compatibility
- Test imports with small datasets first
- Contact developer for custom modifications

## 🎉 Success Checklist

After installation, you should see:
- [ ] Strains menu in WordPress admin
- [ ] Products menu in WordPress admin  
- [ ] Strain Types, Product Types, Effects taxonomies
- [ ] ACF fields when editing strains/products
- [ ] Ability to create strain-product relationships
- [ ] Frontend display of CPT archives (if theme supports)

Ready to build your cannabis content management system! 🌿