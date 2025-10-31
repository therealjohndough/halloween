# Skyworld Cannabis - AI Agent Instructions

## WordPress Theme Development Agents

### codegen
- **Goal**: Generate minimal, correct WordPress implementations with cannabis industry compliance
- **Constraints**: 
  - Follow Skyworld design system (`u-` utility classes)
  - Use authentic strain data only (never fabricate)
  - Implement proper ACF field relationships
  - Maintain hub-and-spoke content model
  - Include NY State compliance features
- **Cannabis-Specific**: Always use strain tags, cannabinoid indicators, and terpene meters for product displays

### reviewer  
- **Goal**: Review diffs for WordPress security, cannabis compliance, performance, and SEO
- **Focus Areas**:
  - **Security**: Proper escaping (`esc_html`, `esc_attr`), sanitization
  - **Compliance**: Age gates, COA accessibility, no medical claims
  - **Performance**: Image optimization, lazy loading, Core Web Vitals
  - **SEO**: Schema markup for cannabis products, structured data
  - **Accessibility**: ARIA labels for cannabis components, keyboard navigation

### docs
- **Goal**: Produce concise, cannabis industry-focused docs with WordPress snippets
- **Requirements**:
  - Include design system usage examples
  - Show cannabis component implementations
  - Provide ACF field mapping patterns
  - Document compliance requirements
  - Include authentic strain data examples

## Design System Agent Rules

### styling
- **Primary Colors**: `#FF8C00` orange, pure black `#000000`
- **Utility Classes**: Always use `u-` prefixes (u-bg-primary, u-text-white)
- **Cannabis Components**: strain-tag, effect-tag, cannabinoid-indicator, terpene-meter
- **Matte Black Mode**: Use `u-mode-matte-black` for ultra-clean aesthetics
- **Responsive**: Mobile-first with `u-md-` and `u-sm-` modifiers

### content
- **Authentic Data Only**: Never create fake strain names or effects
- **Hub-Spoke Model**: Strains link to products, products link to store locator
- **Batch Numbers**: Critical for COA mapping (format: SW051925-HH-SPXPR)
- **Product Naming**: "Strain + Category + Size" format

### compliance
- **NY State OCM**: Always include license numbers
- **Age Gate**: Required for all cannabis content
- **No E-commerce**: Direct to store locator, never shopping cart
- **COA Integration**: Link batch numbers to PDF certificates

## Template Development Patterns

### WordPress Integration
```php
// ACF field retrieval
$strain_name = get_field('strain_name');
$thc_percent = get_field('thc_percent');

// Design system usage
echo '<div class="u-mode-matte-black u-p-lg">';
echo '<h2 class="strain-name">' . esc_html($strain_name) . '</h2>';
echo '<div class="cannabinoid-indicator">';
echo '<span class="cannabinoid-value">' . esc_html($thc_percent) . '%</span>';
echo '</div></div>';
```

### Cannabis Components
```css
.strain-tag           /* Orange strain type indicators */
.strain-tag-glass     /* Glass morphism strain tags */
.effect-tag           /* Green cannabis effect labels */  
.cannabinoid-indicator /* THC/CBD percentage displays */
.cannabinoid-indicator-glass /* Glass morphism THC/CBD */
.terpene-meter        /* Visual terpene profile bars */
.terpene-meter-glass  /* Glass morphism terpene meters */
.lab-tested-badge     /* Compliance verification */
.lab-tested-badge-glass /* Glass morphism lab badges */
.premium-badge        /* Premium product markers */
```

### Glass Morphism Components
```css
.u-glass              /* Basic glass morphism utility */
.u-glass-dark         /* Dark glass morphism */
.u-glass-orange       /* Orange tinted glass */
.u-glass-cannabis     /* Cannabis green glass */
.u-glass-terpene      /* Terpene purple glass */
.glass-card           /* Glass morphism product cards */
.glass-button         /* Glass morphism buttons */
.navbar-glass         /* Glass morphism navigation */
.product-card-glass   /* Enhanced glass product cards */
```

### Import/Export Agents
- **Data Integrity**: Validate strain-product relationships
- **Batch Processing**: Handle large CSV imports efficiently  
- **COA Mapping**: Link batch numbers to certificate files
- **Taxonomy Management**: Maintain consistent strain types and effects