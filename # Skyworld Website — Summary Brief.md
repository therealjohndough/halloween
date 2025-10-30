# Skyworld Website — Summary Brief

_Last updated: oct 30, 2025_

## 1) Purpose & Goals
- **Drive retail sales** via a prominent, frictionless **Store Locator** (homepage + sitewide).
- **Immersive product/strain experience** with rich media (macro photos, short video loops, 360°/spin), interactive **terpene visualizations**, and **secondary (not primary) COA access** per NYS compliance.
- **Express the brand**: premium indoor flower, proprietary genetics, and a genuine “love-based” cultivation ethos; subtle **’80s–’00s nostalgia** in language & UI accents.
- **Fast, mobile-first performance** and **full NYS regulatory compliance** (copy, disclaimers, age gate, accessibility).

## 2) Audience
- NY adult consumers seeking **super‑premium indoor flower** and **transparent quality signals** (COA, cultivation process).
- Retail buyers & budtenders who need clear product info and easy store lookup.

## 3) Brand & Tone
- **Premium & professional**, **passionate & authentic**.
- **Subtle nostalgia** (UI microcopy & visual flourishes), never gimmicky.
- **Trustworthy & transparent**: standards, cleanliness, potency, and process.
- Visual style: dark UI option, dramatic photography, typography‑forward; tasteful motion.

## 4) Core Requirements (MVP)
- **Age Gate** (21+) with compliant messaging.
- **Store Locator**: search by city/zip, map + list, retailer detail cards, “Get directions.”
- **Our Flower (Strains)**: archive + single pages; lineage, effects, aroma/flavor, terpene chart, indoor process notes, gallery, **COA (secondary)**, “Find near me.”
- **Products (Hub‑and‑Spoke)**: SKUs (flower, pre-rolls, etc.) tied to strain hub. Related products by shared strain.
- **Our Story**: origin, Indigenous inspiration, cultivation ethos, team snippet.
- **Where to Find Us**: embedded locator + featured partners.
- **Contact**: brand/press/wholesale form with routing.
- **Compliance surfaces**: NYS packaging/marketing rules reflected in copy, disclaimers, and CTAs.

## 5) Proposed Sitemap
- **Home** (age gate → hero, featured strains/products, store locator preview, brand story snippet, latest drops, CTA).
- **Our Flower** (Archive) → **Single Strain** pages.
- **Products** (Archive) → **Single Product** pages.
- **Our Story**
- **Where to Find Us** (full locator)
- **Contact**

## 6) Key Page Specs
### Home
- Hero with premium product photography/video loop.
- “Find Skyworld Near You” module (zip/city input, map snippet).
- Featured strains (cards), featured products, brand ethos strip, compliance footers.

### Strain (Single)
- Title, **type** (Indica/Sativa/Hybrid), **genetics** (lineage).
- **Effects, aroma, flavor** (concise bullets), **terpene visualization**.
- **Indoor cultivation notes** (Skyworld Standard), gallery (macro/360° optional).
- **COA link (secondary placement)**; **Find near me** CTA.
- Related products linked by same strain.

### Product (Single)
- Product type (flower, pre‑rolls, etc.), size/weight, batch notes where allowed.
- Flavor/experience highlights tied to the strain; gallery.
- COA link (secondary), **Find near me** CTA.
- Related strains and sibling SKUs.

### Store Locator
- Search by zip/city, map + list, partner detail pages (hours, address, link).
- Deep links from product/strain pages pre-filling search.

## 7) Content Model (WordPress)
- **CPT: `strains`** with ACF fields: description, lineage, type, effects, aroma, flavor, terpene data, indoor notes, gallery, COA file/URL, store-locator tag.
- **CPT: `products`** with fields: strain relationship, product type, weight/pack size, batch ID (where applicable), gallery, COA (secondary), retailer availability hint.
- **Taxonomies**: product_type (flower, pre-rolls…), size_weight (e.g., 3.5g), attributes (terpenes/effects where useful for filters).
- **COA Documents**: mapped to strain/product with strict file naming and secondary display.
- **Relationships**: strain ↔ products; related products by shared strain; “Find near me” uses locator query.

## 8) Tech & Integrations
- **Platform**: Custom WordPress theme (performance‑first; minimal plugins; ACF for CPT fields; Customizer for theme options; modular CSS).
- **Store Locator**: Map provider (Mapbox or Google Maps) with retailer data JSON; optional CMS for retailer entries.
- **Media**: Next‑gen image formats, lazy loading, video short loops; optional 360° viewer.
- **Analytics**: GA4 + privacy‑safe events; conversion for “Get Directions,” “Call,” “Find near me.”
- **SEO**: schema for Product, Organization, and LocalBusiness where appropriate; fast Core Web Vitals.

## 9) Compliance & Accessibility
- Prominent **Age Gate** (21+), adult‑use disclaimers, **COA secondary placement**, no medical claims, packaging/marketing copy aligned with NY OCM rules.
- **Accessibility**: semantic HTML, alt text, focus states, color contrast, reduced‑motion respect.

## 10) Performance & QA
- Lighthouse 90+ targets (mobile), image CDNs, caching, prefetch for locator.
- QA checklist: age gate, link hygiene, COA links, mobile tap targets, keyboard nav, 404s, schema validation.

## 11) Design Notes
- Premium, photography‑led; typography emphasis; subtle retro cues in micro‑interactions and copy.
- Optional **dark mode**; restrained color palette; soft shadows; modern cards and grids.
- Motion: micro transitions; scroll‑based reveals kept lightweight.

## 12) Launch Deliverables
- Theme + CPT/ACF config; sample content for 6–10 strains & 10–15 SKUs.
- Store locator with initial retailer list.
- Analytics configured; SEO base; XML sitemap; robots; schema.
- One‑page **COA policy** explaining secondary placement and access.
- Admin docs for content entry (strains/products/COAs/retailers).

---
