# Global Copilot Instructions (Workspace‑wide)


## Voice & Output
- Be direct, concise, and practical. Prefer code over explanation.
- Default to US English. Use present tense, active voice.
- When generating names, pick descriptive, boring names over clever ones.
- When creating docs or copy, favor scannable structure: headings, bullets, short paragraphs.


## Coding Stack & Defaults
- WordPress/PHP: target WP 6.x+, PHP 8.2+. No deprecated functions. Escape output (`esc_html`, `esc_attr`, `wp_kses_post`). Nonces on forms. Use `wp_enqueue_*` for assets. No inline SQL; use `$wpdb->prepare`.
- JS: vanilla JS or jQuery for WordPress compatibility. ES2022+ syntax when possible. Strict mode (`"use strict"`).
- CSS: modern CSS first. Use CSS variables and logical properties. Respect prefers‑reduced‑motion.
- Accessibility: semantic HTML, labels for inputs, keyboard nav, focus states, color contrast >= 4.5:1.
- Performance: lazy load heavy assets, defer non‑critical JS, preconnect critical origins. Avoid blocking main thread. Target Lighthouse 90+ mobile.
- Security: never commit secrets. Sanitize inputs, escape outputs. Use prepared statements. Avoid eval/dynamic `Function`.
- SEO: semantic structure (H1–H3), descriptive titles/meta, `alt` text, canonical links when duplicate paths exist. Use schema markup for Product, Organization, LocalBusiness.
- Cannabis Compliance: age gates (21+), disclaimers, secondary COA placement, no medical claims, NYS OCM alignment.
- Business Model: hub-and-spoke content model - no e-commerce, all CTAs drive to store locator for retail partner discovery.


## Git Hygiene
- Small, atomic commits with imperative summaries (<= 72 chars). Include rationale when non‑obvious.
- Provide PR descriptions with: context, changes list, risk, test notes.


## Tests & QA
- Generate unit tests for utilities and critical logic. Use PHPUnit for WordPress.
- Include minimal repro steps in bugfix PR templates.


## Documentation
- For new features: include a short README section with purpose, usage, and constraints.
- For public APIs: include JSDoc/PHPDoc with types and param/return descriptions.


## Style Rules
- JavaScript: use strict mode, meaningful variable names, avoid global scope pollution.
- PHP: PSR‑12 formatting, snake_case for WP filters/actions, CamelCase for classes.


## Do Not
- Do not add new runtime dependencies without explaining why and impact.
- Do not scaffold example code that won't compile or run.
- Do not output secrets, tokens, or private keys. If asked, refuse.
- Do not use `!important` unless documented justification.
- **NEVER create fake strain names or product data. ALWAYS use authentic Skyworld data from the product inventory CSV files in Project Documents and Data Sources/. Real strains include: Stay Puft, Garlic Gravity, Sherb Cream Pie, Skyworld Wafflez, Dirt n Worms, White Apple Runtz, 41 G, Melted Strawberries, Triple Burger, Charmz, Superboof, Stay Melo, Gushcanna, Lemon Oreoz, Peanut Butter Gelato, Kept Secret - with their actual THC/CBD percentages, terpene profiles, and batch numbers.**


## Project Conventions
- File structure: `src/` for source, `assets/` for static, `includes/` for WP PHP, `templates/` for theme views.
- Custom Post Types: `strains`, `products` with ACF field groups. Use taxonomies for product_type, size_weight.
- Relationships: strain ↔ products bidirectional; related products by shared strain.
- CTAs: all product/strain pages lead to "Find near me" store locator, never direct sales or cart functionality.
- Media: next-gen formats (WebP/AVIF), lazy loading, video short loops, optional 360° viewers.
- Maps: Mapbox or Google Maps for store locator with retailer JSON data - primary conversion goal.
- Env: `.env` for local only; never commit. Document required ENV keys in README.


## Review Checklist (auto‑apply to generated diffs)
- [ ] Security: sanitization/escaping
- [ ] Accessibility: labels, roles, focus order, contrast
- [ ] Performance: bundle size, lazy loading, network hints
- [ ] SEO: semantic headings, metadata, `alt`
- [ ] Tests/docs updated