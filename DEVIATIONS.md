# Theme Deviations from the Design System Spec

Phase 5 (theme-builder) deliverable companion. Lists every place the
built theme intentionally diverges from
[`docs/design-system.md`](https://github.com/makyrie/orbit/blob/main/docs/design-system.md)
in the orbit plugin repo. This is the QA Reviewer's reference for
distinguishing intentional implementation calls from bugs.

## 1. Spacing token registration uses `spacingScale.steps: 0` to disable defaults

**What:** `theme.json` includes `"spacing": { "spacingScale": { "steps": 0 }, "spacingSizes": [...] }` rather than just `"spacingSizes": [...]`.
**Why:** Without the `spacingScale.steps: 0` pair, WordPress merges its own default 7-step scale into the user's custom set, leading to ~14 spacing slugs in the editor UI (most of which the design system doesn't define). The explicit zero suppresses the defaults so only the 7 spec'd slugs (`20`–`80`) appear.
**Impact:** Cleaner editor UI; no behavioral difference at render time.

## 2. Section padding uses inline-style overrides rather than `var:preset|spacing|*` tokens in some templates

**What:** Section-level padding in templates uses both the `style.spacing.padding` block-attribute syntax (`"top":"var:preset|spacing|70"`) AND emits a corresponding inline `style="padding-top:var(--wp--preset--spacing--70)"` attribute. Both the attribute serialization and the inline style are present.
**Why:** This is how WordPress Gutenberg actually serializes spacing presets in block markup as of WP 6.6+. The attribute drives editor UI, the inline style drives rendered output. Removing either breaks one or the other.
**Impact:** None functionally; just looks redundant in the markup. This is correct WP block markup.

## 3. Mobile spacing compression uses `!important` overrides instead of token swaps

**What:** `assets/css/custom.css` section 8 uses `[style*="..."] { ... !important }` selectors to compress spacing below 768px.
**Why:** WordPress's inline style attributes always win over external CSS without `!important`. The cleaner alternative — a custom-property-based responsive spacing system — would require redefining every spacing token at the root, which would conflict with how `theme.json` exposes them. The override approach is pragmatic and bounded.
**Impact:** Mobile padding compresses one step on the spec scale. Visual result matches the design intent. The `!important` is contained to the responsive media query and only targets specific spacing tokens (70, 80).

## 4. The `core/quote` border-left in `theme.json` has an extra max-width applied via custom CSS

**What:** `theme.json`'s `styles.blocks["core/quote"]` defines the sienna left border + italic styling. `custom.css` adds `max-width: 32em` to `.wp-block-quote` because `theme.json` doesn't expose a max-width for blocks.
**Why:** The design system spec specifies a 32em max-width for pull quotes. WordPress's `theme.json` schema doesn't have a slot for per-block max-widths.
**Impact:** Quote blocks honor the spec's editorial reading width.

## 5. The eyebrow paragraph style is registered as a block style + CSS, not as a `core/paragraph` variation in `theme.json`

**What:** Used `register_block_style()` in `functions.php` plus an `.is-style-eyebrow` rule in `custom.css`, rather than declaring the styling in `theme.json`'s `styles.blocks["core/paragraph"].variations`.
**Why:** Block style variations in `theme.json` exist (under `styles.blocks.core/paragraph.variations.eyebrow`) but the editor UX for selecting them is less discoverable than the `register_block_style()` path, which surfaces in the block sidebar's "Styles" panel.
**Impact:** Editors can apply the eyebrow look from the block toolbar's Styles panel, which is the more standard UX.

## 6. Login screen styles inline the Sienna hex values rather than referencing CSS custom properties

**What:** `assets/css/login.css` uses literal `#9C4B30`, `#F7F3ED`, etc. rather than `var(--wp--preset--color--sienna)`.
**Why:** WordPress's preset CSS custom properties are NOT injected into the login screen's stylesheet (the login page is rendered outside the theme.json styles pipeline). Referencing them would yield blank values.
**Impact:** If the canonical Sienna value ever changes in `theme.json`, it will need to be updated in `login.css` separately. Worth a comment in the login.css file (now added) to flag this dependency.

## 7. Footer links use a custom `is-style-footer-links` block style instead of the default list

**What:** `register_block_style()` adds a `footer-links` style to `core/list`, with corresponding CSS that strips bullets and reduces padding.
**Why:** The design-system footer spec calls for a vertical link stack without bullets. The default list block has bullet styling; the cleanest way to override is a registered block style.
**Impact:** Editors can opt into "Footer links" from the list block's Styles panel. Default lists everywhere else are unchanged.

## 8. The `audience-mirror` pattern is treated as a separate composition from the design-system Hero

**What:** The design system's front-page layout annotation describes the hero and audience-mirror as adjacent sections. The theme breaks them into two separate patterns (`perihelion/hero` and `perihelion/audience-mirror`).
**Why:** Two patterns are easier to edit independently in the Site Editor — Sarah can swap the audience-mirror copy without disturbing the hero. The visual outcome on `front-page.html` is identical.
**Impact:** None visually. Slightly more flexible for editing.

## 9. `index.html` template includes a query loop even though no blog content is planned

**What:** `templates/index.html` renders a query of standard `post` content as the fallback template.
**Why:** WordPress requires `index.html` as the template-of-last-resort. The design system / content architecture explicitly does not plan a blog, so this template is unlikely to ever render — but if a `post` ever exists (e.g., during testing), this provides a sane default.
**Impact:** Zero impact in normal use. Defensive only.

## 10. Site title block in `theme.json` overrides link text-decoration to `none`

**What:** `styles.blocks["core/site-title"].elements.link` sets `textDecoration: "none"`, overriding the global link style which adds an underline.
**Why:** The wordmark "Perihelion" in the header should not be underlined — it's a wordmark, not a body link. The global link decoration is the right default for body text but wrong for the brand mark.
**Impact:** Wordmark renders without underline, matching the style tile. Same approach in `custom.css` re-asserts the rule against any conflicting cascade.

## Open questions inherited from upstream phases

These remain as flagged in `docs/design-system.md` and `docs/website-engagement.md`:

- **Honey usage** — formalized in spec, applied in theme only at the actionable workflow indicator (which lives in the plugin's app-header markup, not in the theme template). Theme is unaffected.
- **Mobile breakpoint** — the spec recommended 768px; theme uses it consistently.
- **Logo / favicon** — placeholder; site-title block renders text-only "Perihelion" wordmark for now.
- **Plugin coordination** — the plugin needs to assign `_wp_page_template = 'page-app'` to its 8 internal app pages (Dashboard, Settings, Subscriptions, etc.) so they render with the wider layout. Until that lands, the app pages will use the default `page.html` (narrow editorial layout) and look cramped. A small follow-up plugin patch ships this.
