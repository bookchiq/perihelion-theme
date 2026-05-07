---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, gutenberg, patterns, theme]
dependencies: []
---

# Drop wp:html wrapper around CTA shortcode in patterns

## Problem Statement

The CTA shortcode in `patterns/hero.php:28-30` and `patterns/closing-cta.php:27-29` is wrapped in `<!-- wp:html --> ... <!-- /wp:html -->` block delimiters. This wrapper introduces two related risks:

- Sites that disable `core/html` via `disallowed_block_types_all` would silently drop the CTA from the rendered pattern.
- Pattern previews fetched by the block-editor inserter (`/wp/v2/block-patterns/patterns`) resolve the shortcode in the editor user's context, baking that user's CTA variant into the cached preview HTML.

The wrapper is also unnecessary. PHP patterns already execute as PHP files at `WP_Block_Patterns_Registry::get_content()` time (`ob_start(); include $file; ob_get_clean();`), and the shortcode returns proper button-block markup. Without a wrapper, the markup ends up as freeform content which `do_blocks()` emits as-is.

## Proposed Solution

Drop the `wp:html` wrapper in both files so the shortcode output flows through as freeform block markup:

```php
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
    <?php echo do_shortcode( '[orbit_cta]' ); ?>
</div>
```

After the change, verify the rendered output still contains the button HTML and matches the theme's button styling on both the hero and closing-CTA patterns.

## Acceptance Criteria

- [ ] `patterns/hero.php` no longer contains `<!-- wp:html -->` delimiters around the CTA shortcode.
- [ ] `patterns/closing-cta.php` no longer contains `<!-- wp:html -->` delimiters around the CTA shortcode.
- [ ] Front-end rendering of both patterns is visually identical to the wrapped version.
- [ ] Block-editor inserter previews of both patterns render the CTA correctly.
- [ ] No regression when `core/html` is disallowed via `disallowed_block_types_all`.
