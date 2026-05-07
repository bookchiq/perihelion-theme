---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, php, hooks]
dependencies: []
---

# Promote anonymous list-item filter closure to a named function

## Problem Statement

The `render_block_core/list-item` filter at `functions.php:188-200` is registered as an anonymous closure. Closures cannot be removed via `remove_filter()` because the callback signature isn't shareable across files. If a child theme, sibling plugin, or staging override needs to disable the filter (e.g. to preview the full nav as a logged-out admin), there's no escape hatch. Anonymous closures also obscure debugging — they appear as opaque entries in `$wp_filter`.

## Proposed Solution

Promote the closure to a named function (e.g. `perihelion_filter_app_nav_list_item`) and register it via `add_filter()`. Example:

```php
function perihelion_filter_app_nav_list_item( $block_content, $block ) {
    // existing logic from the closure body
    return $block_content;
}
add_filter( 'render_block_core/list-item', 'perihelion_filter_app_nav_list_item', 10, 2 );
```

This makes the callback removable and visible in `$wp_filter` output for debugging.

## Acceptance Criteria

- [ ] The closure at `functions.php:188-200` is replaced with a named function.
- [ ] The function is registered via `add_filter()` with the same priority and accepted args.
- [ ] `remove_filter( 'render_block_core/list-item', 'perihelion_filter_app_nav_list_item', 10 )` successfully removes it.
- [ ] App nav rendering on `parts/header-app.html` is unchanged from before the refactor.
- [ ] The function appears in `$wp_filter['render_block_core/list-item']` debug output by name.
