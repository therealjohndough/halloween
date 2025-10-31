# Repository Cleanup - Files to Delete

## PRIORITY 1: Safe to Delete Immediately

### Duplicate/Legacy Theme Templates
**Location**: `/wp-content/themes/skyworld-cannabis/`
- `archive-cannabis_product.php` ❌ (superseded by `archive-products.php`)
- `single-cannabis_product.php` ❌ (superseded by `single-products.php`)
- `archive-strain.php` ❌ (superseded by `archive-strains.php`)
- `single-strain.php` ❌ (superseded by `single-strains.php`)
- `single-strain-backup.php` ❌ (backup file no longer needed)

### System Files
**Location**: Root and various directories
- `.DS_Store` ❌ (macOS system file)
- Any additional `.DS_Store` files in subdirectories

### Legacy HTML Templates (Converted to PHP)
**Location**: Root directory
- `skyworld-archive-page.html` ❌ (converted to archive-products.php)
- `skyworld-product-page.html` ❌ (converted to single-products.php)

## PRIORITY 2: Development/Test Files

### Root Level Import Scripts (Superseded)
**Location**: Root directory
- `complete-import.php` ❌ (superseded by organized import-scripts/)
- `skyworld-import.php` ❌ (superseded by comprehensive importer)
- `run-complete-import.php` ❌ (superseded)
- `run-import-fixed.php` ❌ (superseded)
- `run-import-live.php` ❌ (superseded)

### Image Creation Test Scripts
**Location**: Root directory
- `create_images.php` ❌ (development/testing script)
- `create_product_images.php` ❌ (development/testing script)
- `create_real_images.php` ❌ (development/testing script)
- `test-theme.php` ❌ (development/testing script)

## PRIORITY 3: Legacy Site Files

### Old September Site Directory
**Location**: Root directory
- `skyworld sep site/` ❌ **ENTIRE DIRECTORY**
  - Contains old site files from September that are no longer needed
  - Includes: `.DS_Store`, legacy PHP templates, old migrator scripts

## PRIORITY 4: Review Before Delete

### JSON/Data Files (Need Review)
**Location**: Root directory
- `skyworld-hero-slider-json.json` ⚠️ (review if still needed for hero slider)
- `skyworld_products_acf_import.json` ⚠️ (may be backup of ACF fields)
- `skyworld_products_agent.json` ⚠️ (agent-generated data - review content)
- `acf-fields-export.json` ⚠️ (backup of ACF field definitions - keep for now)

### CSV Files (Duplicate Check)
**Location**: Root directory and Project Documents
- `skyworld-strains-library-import.csv` ⚠️ (check if duplicate of file in Project Documents)
- `skyworld_products_with_seo.csv` ⚠️ (review if still needed)

## KEEP - Important Files

### Essential Theme Files
- `archive-products.php` ✅ (professional template)
- `single-products.php` ✅ (professional template)
- `archive-strains.php` ✅ (professional template)
- `single-strains.php` ✅ (professional template)
- `functions.php` ✅ (core theme functionality)
- `style.css` ✅ (theme stylesheet)
- All files in `assets/` ✅ (fonts, CSS, JS, images)

### Essential Import Scripts
- `import-scripts/skyworld-comprehensive-import.php` ✅ (main importer)
- All files in `Project Documents and Data Sources/` ✅ (source data)

### Documentation
- `README.md` ✅
- `MIGRATION-PLAN.md` ✅
- `DEPLOYMENT-MANIFEST.md` ✅
- `THEME-BUILD-SUMMARY.md` ✅

## Deletion Commands (Execute After Approval)

```bash
# Priority 1 - Safe Deletes
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/wp-content/themes/skyworld-cannabis/archive-cannabis_product.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/wp-content/themes/skyworld-cannabis/single-cannabis_product.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/wp-content/themes/skyworld-cannabis/archive-strain.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/wp-content/themes/skyworld-cannabis/single-strain.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/wp-content/themes/skyworld-cannabis/single-strain-backup.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/.DS_Store
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/skyworld-archive-page.html
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/skyworld-product-page.html

# Priority 2 - Development Files
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/complete-import.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/skyworld-import.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/run-complete-import.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/run-import-fixed.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/run-import-live.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/create_images.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/create_product_images.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/create_real_images.php
rm /Users/dough/VS\ Studio\ Projects/oct30-sw/test-theme.php

# Priority 3 - Legacy Directory
rm -rf /Users/dough/VS\ Studio\ Projects/oct30-sw/skyworld\ sep\ site/
```

**Total Files to Delete**: ~20 individual files + 1 entire legacy directory

**Estimated Space Savings**: Significant cleanup of duplicate templates and legacy files

**Risk Level**: LOW - All identified files are either duplicates, superseded, or development artifacts