# SkyWorld Cannabis Site Migration Plan
## Complete WordPress Replacement Strategy

### Current Site Analysis (PRESERVE ALL FUNCTIONALITY)

#### ✅ Critical Backend Systems Identified:
1. **Store Locator**: 95+ dispensary locations with direct links to retailer inventory
2. **COA System**: Google Drive integration with batch-number linking
3. **Product Catalog**: 17+ products with terpene/cannabinoid taxonomy
4. **Newsletter Signup**: Lead generation functionality
5. **Terpene Taxonomy**: Advanced filtering system
6. **Social Integration**: Instagram linkage

#### ✅ Current URL Structure to Preserve:
- `/cannabis-products/` - Main product archive
- `/cannabis-products/[product-name]/` - Individual products
- `/labs/` - COA system  
- `/store-locator/` - Dispensary finder
- `/news/` - Blog/news posts
- `/contact/` - Contact forms
- `/privacy-policy/` - Legal pages

### Migration Strategy: Zero Downtime Replacement

#### Phase 1: Template Deployment (IMMEDIATE)
Upload our professional WordPress templates to replace basic ones:

```bash
# Upload professional templates (SFTP working)
/single-products.php    → Enhanced product pages with ACF integration
/archive-products.php   → Professional product listings with filtering  
/single-strains.php     → Strain hub pages with relationships
/archive-strains.php    → Strain library with taxonomy
```

#### Phase 2: Data Import & Relationships (NEXT)
Execute comprehensive import to populate 35+ products:

```php
// Import creates proper relationships
Strain (Hub) ←→ Products (Spokes) → Store Locator (Conversion)

// Product naming format: "Stay Puft Pre-roll 0.5g, 2pk"
// Batch numbers link to COAs: SW051925-HH-SPXPR
```

#### Phase 3: SEO Preservation & Enhancement 

**URL Mapping & Redirects:**
```
OLD: /product/stay-puft/
NEW: /products/stay-puft-flower-3-5g/
ACTION: 301 redirect with meta preservation
```

**Enhanced Schema Markup:**
```json
{
  "@type": "Product",
  "name": "Stay Puft Flower 3.5g",
  "brand": "Skyworld Cannabis",
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock"
  },
  "additionalProperty": [
    {
      "@type": "PropertyValue", 
      "name": "THC",
      "value": "25.9%"
    },
    {
      "@type": "PropertyValue",
      "name": "Terpenes", 
      "value": "Myrcene 0.74%, Linalool 0.52%"
    }
  ]
}
```

**Core Web Vitals Optimization:**
- Lazy loading for product images
- Preconnect to Google Drive (COA system)
- SkyFont optimization via `font-display: swap`
- Critical CSS inlining
- Service Worker for offline functionality

#### Phase 4: Advanced Cannabis SEO

**Terpene & Cannabinoid Markup:**
```php
// Enhanced product schema with cannabis-specific data
'cannabinoid_profile' => [
    'THC' => 25.9,
    'CBD' => 0.6, 
    'CBG' => 1.2
],
'terpene_profile' => [
    'Myrcene' => 0.74,
    'Linalool' => 0.52,
    'b-Caryophyllene' => 0.48
]
```

**Local Business Integration:**
```json
{
  "@type": "LocalBusiness",
  "@id": "https://skyworldcannabis.com/#organization",
  "name": "Skyworld Cannabis",
  "address": {
    "@type": "PostalAddress",
    "addressRegion": "NY",
    "addressCountry": "US"
  },
  "license": "OCM-PROC-24-000030 | OCM-CULT-2023-000179"
}
```

### Technical SEO Upgrades

#### Performance Enhancements:
- **Target**: Lighthouse 95+ mobile score
- **Critical Resource Hints**: `<link rel="preconnect" href="https://drive.google.com">`
- **Image Optimization**: WebP format with fallbacks
- **JavaScript**: Defer non-critical, inline critical CSS
- **Caching**: Implement service worker for repeat visits

#### Cannabis Compliance SEO:
- Age gate with proper crawling directives
- COA accessibility for transparency
- NY State license prominent display
- No medical claims language
- Proper adult-use disclaimers

### Backend Functionality Preservation

#### Store Locator (95+ Locations):
```php
// Maintain all retailer integrations
- Dutchie API connections preserved
- Direct "Shop Now" links maintained  
- Phone numbers and hours preserved
- Geographic search functionality enhanced
```

#### COA System Enhancement:
```php
// Google Drive integration preserved + enhanced
function get_coa_by_batch($batch_number) {
    // Current: Google Drive links
    // Enhanced: Batch number validation, auto-linking
    return "https://drive.google.com/file/d/{$file_id}/view";
}
```

#### Newsletter & Lead Generation:
- Form functionality preserved
- Privacy policy compliance maintained
- Enhanced conversion tracking

### Migration Execution Timeline

**Week 1 (IMMEDIATE):**
1. ✅ Upload professional templates via SFTP
2. ✅ Execute import script for 35+ products  
3. ✅ Test all functionality on live server
4. ✅ Implement 301 redirects for changed URLs

**Week 2 (ENHANCEMENT):**
1. Add advanced schema markup
2. Implement Core Web Vitals optimizations
3. Enhanced terpene/cannabinoid SEO
4. Local business markup for dispensaries

**Week 3 (VALIDATION):**
1. SEO audit and validation
2. Performance testing
3. Functionality verification
4. Search Console monitoring

### Risk Mitigation

**SEO Protection:**
- All current URLs redirected properly
- Meta data preserved and enhanced
- Schema markup maintains current + adds new
- XML sitemap updated automatically

**Functionality Backup:**
- Store locator data preserved
- COA links maintained
- Newsletter signups continue
- Social media integration intact

**Performance Monitoring:**
- Core Web Vitals tracking
- Search ranking monitoring
- Conversion rate tracking
- User experience metrics

### Success Metrics

**SEO Improvements:**
- Lighthouse score: 70+ → 95+
- Page load time: <2s
- SEO score improvement: +20%
- Enhanced rich snippets display

**Functionality Enhancements:**
- Professional template design
- Enhanced product relationships
- Improved mobile experience  
- Better conversion flow to store locator

**Cannabis Industry Compliance:**
- NY State regulations maintained
- Enhanced transparency (COAs)
- Professional brand presentation
- Competitive SEO advantage

---

**READY TO EXECUTE**: All templates created, import script tested, SFTP access confirmed. 
**ZERO DOWNTIME**: Migration preserves all functionality while adding major enhancements.
**SEO SAFE**: 301 redirects, meta preservation, enhanced structured data.