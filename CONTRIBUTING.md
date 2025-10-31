# Contributing to Skyworld Cannabis Theme

## 🌿 Cannabis Industry Standards

This theme follows strict cannabis industry compliance and professional development standards.

### Code Standards

#### WordPress Coding Standards
- Follow WordPress PHP Coding Standards
- Use proper escaping: `esc_html()`, `esc_attr()`, `esc_url()`
- Sanitize all inputs: `sanitize_text_field()`, `sanitize_email()`
- Prefix all functions with `skyworld_`

#### Cannabis Compliance Requirements
- **Never** create fake strain names or effects
- Use only authentic Skyworld genetics data
- Include NY State OCM license numbers
- Implement age gate verification (21+)
- Direct conversions to store locator (no e-commerce)

#### Design System Standards
```css
/* Use utility-first approach */
.u-bg-primary          /* Skyworld orange background */
.u-mode-matte-black    /* Ultra-clean black aesthetic */

/* Cannabis components must include glass variants */
.strain-tag            /* Base component */
.strain-tag-glass      /* Glass morphism variant */
```

### Development Workflow

1. **Branch Naming**: `feature/strain-profile-updates` or `fix/age-gate-validation`
2. **Commit Messages**: Follow conventional commits
   ```
   feat(strains): add glass morphism terpene meters
   fix(compliance): update NY OCM license numbers
   docs(readme): improve installation instructions
   ```
3. **Testing**: Verify all changes on local WordPress installation
4. **Security**: Run PHP linting and security scans

### Pull Request Guidelines

#### Required Checks
- [ ] PHP syntax validation passes
- [ ] WordPress coding standards compliance
- [ ] Cannabis compliance requirements met
- [ ] Design system classes used properly
- [ ] No fabricated cannabis data
- [ ] Age gate functionality preserved
- [ ] Store locator conversion flow intact

#### PR Template
```markdown
## Changes Made
- Brief description of changes

## Cannabis Compliance
- [ ] No medical claims added
- [ ] Age gate functionality preserved
- [ ] OCM license numbers current
- [ ] Store locator conversion maintained

## Testing
- [ ] Local WordPress installation tested
- [ ] Mobile responsiveness verified
- [ ] Glass morphism effects working
- [ ] Strain data authentic and accurate

## Screenshots
Include before/after screenshots for UI changes
```

### Authentic Data Requirements

#### Approved Skyworld Strains
Use only these authentic genetics:
- Stay Puft, Garlic Gravity, Sherb Cream Pie
- Skyworld Wafflez, Dirt n Worms, White Apple Runtz
- 41 G, Melted Strawberries, Triple Burger
- Charmz, Superboof, Stay Melo, Gushcanna
- Lemon Oreoz, Peanut Butter Gelato, Kept Secret

#### Batch Number Format
- Format: `SW051925-HH-SPXPR`
- Links to COA PDFs in `/assets/coas/`
- Required for compliance tracking

### Security Guidelines

#### Input Sanitization
```php
// Always sanitize user inputs
$strain_name = sanitize_text_field($_POST['strain_name']);
$thc_percent = floatval($_POST['thc_percent']);
$batch_number = sanitize_text_field($_POST['batch_number']);
```

#### Output Escaping
```php
// Always escape outputs
echo esc_html($strain_name);
echo esc_attr($batch_number);
echo esc_url($store_locator_url);
```

#### WordPress Security
- Use nonces for form submissions
- Validate user capabilities
- Sanitize database queries
- Follow WordPress security best practices

### Performance Standards

#### Requirements
- Lighthouse score 90+ on mobile
- Core Web Vitals all green
- Page load under 3 seconds on 3G
- WebP images with fallbacks

#### Optimization Checklist
- [ ] Images optimized and properly sized
- [ ] CSS minified for production
- [ ] JavaScript deferred when possible
- [ ] Lazy loading implemented
- [ ] Critical CSS inlined

### Cannabis Component Guidelines

#### Glass Morphism Implementation
```css
/* Base component */
.strain-tag {
  background: var(--color-primary);
  padding: var(--space-xs) var(--space-sm);
  border-radius: var(--radius-md);
}

/* Glass morphism variant */
.strain-tag-glass {
  @extend .strain-tag;
  backdrop-filter: blur(10px);
  background: rgba(255, 140, 0, 0.1);
  border: 1px solid rgba(255, 140, 0, 0.2);
}
```

#### Required Cannabis Components
- Strain tags with glass variants
- Cannabinoid indicators (THC/CBD)
- Terpene profile meters
- Lab tested badges
- Premium product markers

### Documentation Standards

#### Code Comments
```php
/**
 * Display authenticated Skyworld strain information
 * 
 * @param int $strain_id The strain post ID
 * @param bool $show_glass Whether to use glass morphism styling
 * @return void
 */
function skyworld_display_strain($strain_id, $show_glass = false) {
    // Implementation here
}
```

#### README Updates
- Update feature lists for new functionality
- Include code examples for new components
- Document compliance requirements
- Provide installation/usage instructions

### Legal & Compliance

#### NY State Cannabis Regulations
- Display OCM license numbers: OCM-PROC-24-000030 | OCM-CULT-2023-000179
- Implement age verification (21+)
- No medical claims or therapeutic benefits
- No e-commerce functionality (direct to licensed retailers)

#### Content Guidelines
- Educational content only
- No health/medical claims
- Professional industry terminology
- Authentic product information only

### Support & Questions

For cannabis compliance questions or technical support:
1. Review existing documentation first
2. Check cannabis industry regulations
3. Verify against NY State OCM requirements
4. Consult with legal compliance team if needed

---

**Remember**: This theme represents a premium cannabis brand. All contributions must maintain professional standards and regulatory compliance.