# SEO Strategy for Skyworld Cannabis

## Current State

### Strains
✅ Have meta_title and meta_description in CSV
- Example: "Lemon Oreoz | Skyworld Cannabis"
- Example: "Lemon Oreoz (Oreoz × Monkey Spunk): zesty-sweet cookie dough with a creamy finish. Skyworld Cannabis."

### Products
❌ NO SEO metadata in CSV
- Need to add: meta_title, meta_description, focus keywords

## SEO Fields Needed

### For Strains (in ACF):
- `meta_title` - Already in CSV ✅
- `meta_description` - Already in CSV ✅
- `focus_keyword` - Main keyword
- `meta_robots` - Index/NoIndex
- `og_image` - Social sharing image
- `canonical_url` - Custom canonical if needed

### For Products (NEW - Need to add):
- `meta_title` - Format: "{Strain} {Type} - THC {X}% | Skyworld Cannabis"
- `meta_description` - Format: "{Type} strain {Strain} from Skyworld Cannabis. {THC}% THC, {terpenes}. Batch {batch}."
- `focus_keyword` - Main keyword
- `meta_robots` - Index/NoIndex
- `og_image` - Social sharing image
- `canonical_url` - Custom canonical if needed

## Product SEO Template

### Meta Title Template:
```
{Strain Name} {Product Type} - {THC}% THC | Skyworld Cannabis
```

Examples:
- "Stay Puft Flower - 25.9% THC | Skyworld Cannabis"
- "Garlic Gravity Pre-roll - 28% THC | Skyworld Cannabis"
- "Peanut Butter Gelato Flower - 28% THC | Skyworld Cannabis"

### Meta Description Template:
```
Premium cannabis {product_type} strain {strain_name} from Skyworld Cannabis. {THC}% THC, {dominant_terpenes}. Batch-tested and lab-verified. Shop at a dispensary near you.
```

Examples:
- "Premium cannabis flower strain Stay Puft from Skyworld Cannabis. 25.9% THC, Myrcene, Linalool, b-Caryophyllene. Batch SW3725J-SP lab-verified. Shop at a dispensary near you."
- "Premium cannabis pre-roll strain Garlic Gravity from Skyworld Cannabis. 28% THC, b-Caryophyllene, Myrcene, Limonene. Batch SW051925-PRE05X2-GG lab-verified."

### Focus Keywords Strategy

**Primary Keywords** (strain level):
- {strain name} cannabis
- {strain name} strain
- {strain name} effects
- best {strain name}

**Secondary Keywords** (product level):
- {strain name} {product type}
- {strain name} {product type} THC
- {strain name} review
- {product type} {strain name}
- {location} {strain name}

**Location Keywords** (to add):
- New York cannabis
- NY dispensary
- {strain} near me
- {strain} in New York

## Schema Markup

Need to add structured data:

### Product Schema (for products):
```json
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{Product Name}",
  "description": "{Meta Description}",
  "brand": {
    "@type": "Brand",
    "name": "Skyworld Cannabis"
  },
  "offers": {
    "@type": "AggregateOffer",
    "availability": "https://schema.org/InStock"
  }
}
```

### CannabisProduct Schema (specific):
- Will use Product schema with cannabis-specific extensions
- Include THC %, CBD %, terpenes
- Include batch number and lab testing info

### LocalBusiness Schema (dispensaries):
- Add to store locator page
- Include OCM license numbers
- Include contact information

## Content Optimization

### Page Types & SEO:

1. **Home Page**
   - Title: "Premium Cannabis Products | Skyworld Cannabis"
   - Description: "Skyworld Cannabis offers premium indoor-grown cannabis products in New York. Explore our strains, products, and lab-tested COAs."
   - Focus: Brand + location + products

2. **Strain Archive (/strains/)**
   - Title: "Cannabis Strains Library | Skyworld Cannabis"
   - Description: "Browse our complete library of premium cannabis strains. Find strains by type, effects, and terpenes."
   - Focus: Strain library, genetics, effects

3. **Strain Single**
   - Title: Use meta_title from CSV
   - Description: Use meta_description from CSV
   - Add breadcrumb: Home > Strains > {Strain}

4. **Product Archive (/cannabis-products/)**
   - Title: "Cannabis Products | Skyworld Cannabis"
   - Description: "Shop premium cannabis products in New York. Flower, pre-rolls, and concentrates with lab-verified COAs."
   - Focus: Products + location + shopping

5. **Product Single**
   - Title: Use new meta_title template
   - Description: Use new meta_description template
   - Add breadcrumb: Home > Products > {Product}

6. **COA Page (/coa/{batch})**
   - Title: "COA for {Product Name} - Batch {batch} | Skyworld Cannabis"
   - Description: "Certificate of Analysis for {Product Name}, batch {batch}. Lab-tested by {lab}."
   - Make sure all COAs are indexable for SEO value

7. **Labs/COAs Page**
   - Title: "Lab Results & COAs | Skyworld Cannabis"
   - Description: "Browse all lab test results and Certificates of Analysis for Skyworld Cannabis products."
   - Focus: Transparency, lab testing, quality

8. **Contact Page**
   - Title: "Contact Us | Skyworld Cannabis"
   - Description: "Get in touch with Skyworld Cannabis. Located in New York. Licensed by OCM."
   - Focus: Contact + location + compliance

## Image SEO

### All Images Need:
- Alt text with keyword
- Descriptive filenames
- Proper dimensions
- Lazy loading

### Alt Text Templates:
- Product images: "{Strain} {Type} - {THC}% THC cannabis"
- Strain images: "{Strain} cannabis strain - {Type}"
- Hero images: "Skyworld Cannabis {page type}"

## URL Structure

✅ Current structure is good:
- `/strains/{strain-slug}/`
- `/cannabis-products/{product-slug}/`
- `/coa/{batch-number}/`

Keep slugs short and descriptive.

## Internal Linking Strategy

1. **Strain → Products**: Show all products for this strain
2. **Product → Strain**: Link to parent strain page
3. **Product → COA**: Link to COA viewer
4. **Archive → Single**: Related items at bottom
5. **Navigation**: Keep breadcrumbs on all pages

## Local SEO

### Key Pages:
- Home page - emphasize location
- Contact page - full business details
- Store locator - list all dispensaries

### Location Keywords:
- New York
- NY
- NYC
- [County/Region]
- "near me"

### NAP (Name, Address, Phone):
- Include in footer
- Include in contact page
- Add to schema markup

### License Numbers:
- OCM-PROC-24-000030
- OCM-CULT-2023-000179
- Display prominently on all pages

## Link Building

Internal:
- Product cards linking to singles
- Strain cards linking to singles
- COA links from products
- Related products/strain sections

External (future):
- Dispensary partnerships
- Industry directories
- News/press mentions

## Technical SEO

### Speed:
- Optimize images
- Lazy load content
- Minimize CSS/JS

### Mobile:
- Ensure all pages are mobile-responsive
- Test on various devices

### Indexing:
- Make sure all products are indexable
- COAs should be indexable
- Archive pages should be indexable
- Use proper robots meta

## Implementation Checklist

- [ ] Add meta_title to products
- [ ] Add meta_description to products  
- [ ] Add focus_keyword to all CPTs
- [ ] Add schema markup to templates
- [ ] Add breadcrumbs to all pages
- [ ] Optimize all images (alt text)
- [ ] Add internal linking
- [ ] Create sitemap.xml
- [ ] Add Google Analytics
- [ ] Submit to Google Search Console
- [ ] Set up local business schema
- [ ] Add license numbers prominently

## Next Steps

1. Wait for you to upload site copy
2. Create ACF SEO field groups with all fields
3. Update import script to generate SEO fields automatically
4. Add schema markup to templates
5. Add breadcrumbs
6. Optimize images

