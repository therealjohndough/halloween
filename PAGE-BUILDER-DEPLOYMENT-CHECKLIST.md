# Page Builder Deployment Checklist

## Pre-Deployment Validation

### 1. File Structure Check
- [ ] `template-page-builder.php` exists in theme root
- [ ] `acf-json/group_skyworld_page_builder.json` exists
- [ ] All block templates exist in `template-parts/blocks/`:
  - [ ] `hero_section.php`
  - [ ] `brand_statement.php`
  - [ ] `content_block.php`
  - [ ] `founder_bio.php`
  - [ ] `strain_profile.php`
  - [ ] `cta_section.php`
- [ ] `assets/css/page-builder.css` exists
- [ ] CSS enqueue added to `functions.php`

### 2. WordPress Requirements
- [ ] Advanced Custom Fields Pro plugin installed and active
- [ ] WordPress 5.0+ (for Gutenberg compatibility)
- [ ] PHP 7.4+ recommended
- [ ] Theme supports `title-tag`, `post-thumbnails`, `custom-logo`

### 3. ACF Field Import
- [ ] Navigate to: Custom Fields → Tools
- [ ] Import `group_skyworld_page_builder.json`
- [ ] Verify field group is active
- [ ] Check location rules target `template-page-builder.php`

## Testing Protocol

### 1. Create Test Page
- [ ] Create new page: "Page Builder Test"
- [ ] Select template: "Page Builder"
- [ ] Add at least 3 different sections
- [ ] Fill in all required fields
- [ ] Save and preview

### 2. Frontend Validation
- [ ] Page loads without errors
- [ ] All sections display correctly
- [ ] Images load with proper alt text
- [ ] CTA buttons link correctly
- [ ] Mobile responsive design works
- [ ] Page builder CSS loads only on template pages

### 3. Content Editor Experience
- [ ] ACF fields are intuitive and well-labeled
- [ ] Field instructions are helpful
- [ ] Drag-and-drop reordering works
- [ ] Required field validation works
- [ ] Field defaults are appropriate

### 4. Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

### 5. Performance Testing
- [ ] Page loads under 3 seconds
- [ ] Images are optimized (WebP preferred)
- [ ] CSS and JS are minified for production
- [ ] No console errors
- [ ] Lighthouse score 90+ recommended

## Security Validation

### 1. Data Sanitization
- [ ] All `get_sub_field()` outputs are escaped
- [ ] URLs use `esc_url()`
- [ ] HTML attributes use `esc_attr()`
- [ ] HTML content uses `wp_kses_post()`
- [ ] User inputs are validated

### 2. Template Security
- [ ] No direct PHP file access (`!defined('ABSPATH')`)
- [ ] Proper nonce verification for forms
- [ ] User capability checks where needed
- [ ] No SQL injection vulnerabilities

## SEO Verification

### 1. Schema Markup
- [ ] JSON-LD schema included in template
- [ ] Organization schema for Skyworld
- [ ] WebPage schema for each page
- [ ] Image schema with alt text

### 2. Content Structure
- [ ] Proper heading hierarchy (H1 → H2 → H3)
- [ ] Meta descriptions available
- [ ] Image alt text required
- [ ] Internal linking opportunities

### 3. Technical SEO
- [ ] Clean URLs (no query parameters)
- [ ] Proper canonical tags
- [ ] Mobile-friendly design
- [ ] Fast loading speeds

## Content Guidelines Compliance

### 1. Brand Consistency
- [ ] Uses Skyworld orange (#FF8C00) and black theme
- [ ] SkyFont family loads correctly
- [ ] Voice and tone match brand guidelines
- [ ] Indigenous heritage references are respectful

### 2. Cannabis Compliance
- [ ] No medical claims in default content
- [ ] Age-appropriate messaging
- [ ] Compliance with NY cannabis regulations
- [ ] No e-commerce functionality (store locator only)

### 3. Accessibility (WCAG 2.1 AA)
- [ ] Proper color contrast ratios
- [ ] Alt text for all images
- [ ] Keyboard navigation support
- [ ] Screen reader compatibility
- [ ] Focus indicators visible

## Documentation Review

### 1. Setup Instructions
- [ ] Installation steps are clear
- [ ] Field import process documented
- [ ] Template selection explained
- [ ] Troubleshooting section complete

### 2. Content Examples
- [ ] Sample content for each block type
- [ ] Image requirement specifications
- [ ] SEO keyword suggestions
- [ ] Writing style guidelines

### 3. Customization Guide
- [ ] Adding new block types explained
- [ ] CSS customization documented
- [ ] PHP template modification guide
- [ ] Version control integration

## Production Deployment

### 1. Environment Preparation
- [ ] Staging environment tested thoroughly
- [ ] Database backup completed
- [ ] File backup completed
- [ ] DNS/CDN configuration ready

### 2. Go-Live Process
- [ ] Upload theme files via FTP/Git
- [ ] Import ACF fields via WordPress admin
- [ ] Test critical pages immediately
- [ ] Monitor error logs for 24 hours
- [ ] Verify Google Search Console

### 3. Post-Launch Monitoring
- [ ] Analytics tracking functional
- [ ] Contact forms working
- [ ] Search functionality operational
- [ ] Mobile performance validated
- [ ] User feedback collection

## Training Materials

### 1. Content Editor Training
- [ ] Video walkthrough of page builder
- [ ] Written guide for each block type
- [ ] Best practices document
- [ ] Common troubleshooting solutions

### 2. Developer Handoff
- [ ] Codebase documentation
- [ ] Git repository setup
- [ ] Staging environment access
- [ ] Update procedures documented

## Success Metrics

### 1. Performance Benchmarks
- [ ] Page load time < 3 seconds
- [ ] Lighthouse Performance > 90
- [ ] Core Web Vitals pass
- [ ] Mobile usability score 100

### 2. User Experience Metrics
- [ ] Bounce rate improvement
- [ ] Time on page increase
- [ ] Conversion rate tracking
- [ ] User feedback collection

### 3. SEO Impact
- [ ] Search rankings monitoring
- [ ] Organic traffic tracking
- [ ] Schema markup validation
- [ ] Mobile-first indexing compliance

## Maintenance Schedule

### 1. Weekly Tasks
- [ ] Check for WordPress/plugin updates
- [ ] Monitor site performance
- [ ] Review error logs
- [ ] Backup verification

### 2. Monthly Tasks
- [ ] Content audit and updates
- [ ] SEO performance review
- [ ] Security scan
- [ ] User experience testing

### 3. Quarterly Tasks
- [ ] Major content refresh
- [ ] Design trend evaluation
- [ ] Competitor analysis
- [ ] Technical debt assessment

## Emergency Procedures

### 1. Rollback Plan
- [ ] Previous theme version backed up
- [ ] Database restoration procedure
- [ ] Emergency contact information
- [ ] Temporary maintenance page ready

### 2. Support Contacts
- [ ] Developer contact information
- [ ] Hosting provider support
- [ ] Domain registrar details
- [ ] CDN/Security service contacts

This checklist ensures a professional, secure, and successful deployment of the Skyworld Cannabis page builder system.