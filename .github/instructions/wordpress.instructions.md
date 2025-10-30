---
description: WordPress/PHP hardening and theme/plugin standards
applyTo: "**/*.{php,inc}"
---
# WordPress/PHP Standards
- Escape on output (`esc_html`, `esc_attr`, `wp_kses_post`).
- Sanitize on input (`sanitize_text_field`, `intval`, `sanitize_email`).
- Nonces for forms and state‑changing requests.
- Use actions/filters; avoid editing core.
- Query with `WP_Query` or `$wpdb->prepare` safe SQL only.
- ACF: use `get_field()` with fallbacks; validate ACF data before output.
- CPT: register with proper capabilities, public/private settings, REST API exposure.
- Taxonomies: hierarchical for categories, non-hierarchical for tags/attributes.
- Age gates: implement with session storage, compliant messaging, proper redirects.
- COA handling: secondary placement, secure file access, proper MIME type validation.
- Internationalize: wrap strings with `__()`/`_e()`; text domain configurable.
- Templates: avoid direct DB calls; pass sanitized data to views.