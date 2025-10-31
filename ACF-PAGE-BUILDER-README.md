f# Skyworld Cannabis Page Builder System

## Overview

This is a complete ACF (Advanced Custom Fields) page builder system for the Skyworld Cannabis WordPress theme. It provides a flexible, reusable template system that allows easy creation and editing of custom page layouts without coding knowledge.

## Features

- **Drag & Drop Sections**: Reorder page sections easily
- **Modular Layouts**: 6+ pre-built section types
- **Mobile Responsive**: All blocks adapt to mobile devices
- **SEO Optimized**: Proper heading structure and schema markup
- **Brand Consistent**: Uses Skyworld's #FF8C00 orange and dark theme
- **Future-Proof**: JSON sync for version control

## Installation

### 1. Import ACF Fields

1. Go to: **WordPress Admin → Custom Fields → Tools**
2. Click **"Import Field Groups"**
3. Upload: `acf-json/group_skyworld_page_builder.json`
4. Click **"Import"**

### 2. Enable ACF JSON Sync (Recommended)

The `acf-json/` folder enables automatic field synchronization:
- Any field changes are auto-saved to JSON files
- Version control tracks field changes
- Easy deployment across environments

### 3. Files Structure

```
wp-content/themes/skyworld-cannabis/
├── template-page-builder.php          # Main page template
├── acf-json/                          # ACF field definitions
│   └── group_skyworld_page_builder.json
├── template-parts/blocks/             # Individual block templates
│   ├── hero_section.php
│   ├── brand_statement.php
│   ├── content_block.php
│   ├── founder_bio.php
│   ├── strain_profile.php
│   └── cta_section.php
└── assets/css/
    └── page-builder.css               # Page builder styling
```

## Available Page Sections

### 1. Hero Section
**Perfect for:** Homepage, landing pages, major announcements

**Fields:**
- Headline (required)
- Subheading text
- Up to 2 CTA buttons
- Background image
- Overlay opacity control

**Best Practices:**
- Keep headlines under 8 words
- Use high-resolution images (1920px+ wide)
- Test overlay opacity for text readability

### 2. Brand Statement Block
**Perfect for:** About sections, company messaging, brand positioning

**Fields:**
- Optional section headline
- Rich text content (WYSIWYG)
- Supporting image
- Layout options (text left/right/center/full)

**Content Ideas:**
- Brand mission and values
- Company story
- Cultural messaging
- Indigenous heritage content

### 3. Content Block
**Perfect for:** Feature descriptions, process explanations, detailed content

**Fields:**
- Section headline
- Optional subtitle
- Rich text content
- Supporting image
- Feature list (bullet points)
- Optional CTA button

**Use Cases:**
- Cultivation process details
- Product quality features
- Sustainability initiatives
- Educational content

### 4. Founder Bio Section
**Perfect for:** About page, team introductions, leadership profiles

**Fields:**
- Founder name
- Title & affiliation
- Biography (rich text)
- Professional photo

**Content Guidelines:**
- Use professional portraits
- Include cultural affiliations respectfully
- Focus on expertise and vision
- Keep bios conversational but authoritative

### 5. Strain Profile Section
**Perfect for:** Individual strain pages, product showcases

**Fields:**
- Strain name
- Type (Indica/Sativa/Hybrid/Specialty)
- Primary effects (checkboxes)
- Aroma & flavor description
- Lineage information
- Terpene profile (repeater)
- Cultivation notes

**Data Entry Tips:**
- Select 3-5 primary effects maximum
- Use descriptive aroma language
- Include dominant terpenes with percentages
- Add cultivation personality to notes

### 6. Call-to-Action Section
**Perfect for:** Conversion points, store locator promotion, contact forms

**Fields:**
- CTA headline
- Supporting text
- Multiple CTA buttons
- Background image (optional)
- Color theme (dark/light/orange)

**Conversion Tips:**
- Use action-oriented headlines
- Limit to 2-3 buttons maximum
- Test different color themes
- Place strategically throughout site

## How to Use

### Creating a New Page Builder Page

1. **Create New Page**
   - Go to: **Pages → Add New**
   - Enter page title

2. **Select Template**
   - In **Page Attributes** → **Template**
   - Choose: **"Page Builder"**

3. **Add Content Sections**
   - Scroll to **"Page Builder Components"**
   - Click **"Add Section"**
   - Choose section type
   - Fill in fields
   - Repeat to add more sections

4. **Reorder Sections**
   - Drag sections up/down using handles
   - Preview changes
   - Update page

### Content Guidelines

#### Writing Style
- Direct, intentional tone (matching Skyworld brand)
- No hype or exaggerated claims
- Cultural respect for Indigenous heritage
- Focus on craft and quality

#### Image Requirements
- **Hero backgrounds**: 1920x1080px minimum
- **Portrait photos**: 800x800px minimum
- **Product images**: 600x600px minimum
- **File formats**: JPG, PNG, WebP
- **Alt text**: Always include descriptive alt text

#### SEO Best Practices
- Use one H1 per page (hero headline)
- Structure content with H2, H3 hierarchy
- Include relevant keywords naturally
- Add meta descriptions
- Use schema markup (built-in)

## Customization

### Adding New Block Types

1. **Create ACF Layout**
   - Edit field group in ACF
   - Add new flexible content layout
   - Define sub-fields
   - Export JSON

2. **Create Template File**
   - Add new PHP file: `template-parts/blocks/your_layout.php`
   - Follow existing block structure
   - Include proper escaping and validation

3. **Add CSS Styles**
   - Add styles to `page-builder.css`
   - Follow mobile-first approach
   - Use CSS variables for consistency

### CSS Variables

The page builder uses these CSS variables:
```css
--primary-color: #FF8C00    /* Skyworld Orange */
--secondary-color: #000     /* Black */
--text-color: #fff          /* White text */
```

### Theme Integration

The page builder integrates with:
- Main theme styles
- Custom fonts (SkyFont family)
- Navigation system
- Footer structure
- Mobile responsiveness

## Troubleshooting

### Common Issues

**"Template Missing" Error**
- Check file naming matches layout name exactly
- Verify file exists in `template-parts/blocks/`
- Check file permissions

**Fields Not Showing**
- Ensure ACF plugin is active
- Import field group JSON
- Check location rules match template

**Styles Not Loading**
- Clear cache (if using caching plugin)
- Check CSS enqueue in functions.php
- Verify template detection

### Debug Mode

Add to wp-config.php for debugging:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Support and Updates

### Field Updates
- Field changes auto-sync to JSON files
- Version control tracks all changes
- Import/export between environments

### Template Updates
- Block templates can be updated individually
- CSS updates apply globally
- Backwards compatibility maintained

### Content Migration
- Existing content preserved during updates
- New fields get default values
- No data loss during theme updates

## Example Content

### Homepage Layout Example
1. **Hero Section**: "Premium New York Indoor Cannabis"
2. **Brand Statement**: Company mission and values
3. **Content Block**: Cultivation process
4. **Content Block**: Genetics selection
5. **CTA Section**: Store locator promotion

### About Page Layout Example
1. **Hero Section**: "A Brand With Roots"
2. **Brand Statement**: Company story
3. **Founder Bio**: Alex Anderson
4. **Founder Bio**: Eric Steenstra
5. **CTA Section**: Contact or learn more

### Strain Page Layout Example
1. **Hero Section**: Strain name and beauty shot
2. **Strain Profile**: Complete strain data
3. **Content Block**: Cultivation notes
4. **CTA Section**: Find retailers

This system provides complete flexibility while maintaining Skyworld's brand consistency and professional presentation.