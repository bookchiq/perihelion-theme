---
status: complete
priority: p3
issue_id: "009"
tags: [code-review, editor-experience, hooks]
dependencies: []
---

# Editor-preview ambiguity for nav filter

## Problem Statement

The `render_block` filter in `functions.php:188-200` runs in the Site Editor REST render context as well as on the front end. A non-poster admin editing `parts/header-app.html` will see only `is-authenticated-only` items rendered (Dashboard / Subscriptions / Settings) and miss `is-poster-only` items in the preview. This makes the template look broken or incomplete during editing, since the editor user's role determines which items the filter strips.

## Proposed Solution

Either short-circuit the filter for REST/editor contexts so previews always show the full structure, or document the behavior so future maintainers understand it.

Preferred: short-circuit at the top of the filter callback:

```php
if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
    return $block_content;
}
```

Alternative: leave the behavior as-is and add a docblock note explaining that editor previews reflect the editing user's capabilities.

## Acceptance Criteria

- [ ] Decision made: short-circuit on REST, or document the behavior in the filter docblock.
- [ ] If short-circuiting: editor previews of `parts/header-app.html` show the complete nav structure regardless of the editing user's role.
- [ ] Front-end behavior is unchanged for all role/auth combinations.
- [ ] Docblock explains the chosen behavior.
