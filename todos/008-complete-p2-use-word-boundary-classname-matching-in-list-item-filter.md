---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, defense-in-depth, php]
dependencies: []
---

# Use word-boundary className matching in list-item filter

## Problem Statement

`functions.php:191` and `functions.php:195` use `strpos( $class_name, 'is-authenticated-only' )` and `strpos( $class_name, 'is-poster-only' )` to detect visibility classes. `strpos` matches any substring occurrence, so classes like `not-is-poster-only` or `is-poster-only-mobile` would also match and trigger the filter unintentionally.

The theme controls all classNames in `parts/header-app.html` today, so this is not a current bug — but it is fragile. A future contributor adding a class like `is-poster-only-tooltip` would silently pull that item into the visibility-filtering branch.

## Proposed Solution

Use a word-boundary check via array membership instead of substring matching:

```php
$classes = preg_split( '/\s+/', trim( $class_name ) );
if ( in_array( 'is-authenticated-only', $classes, true ) ) {
    // ...
}
if ( in_array( 'is-poster-only', $classes, true ) ) {
    // ...
}
```

`style.css` declares `Requires PHP: 8.0`, so `str_contains()` is available — but it has the same substring-matching problem as `strpos`. Array membership is the correct fix.

## Acceptance Criteria

- [ ] `functions.php:191` uses word-boundary matching for `is-authenticated-only`.
- [ ] `functions.php:195` uses word-boundary matching for `is-poster-only`.
- [ ] A class like `not-is-poster-only` or `is-poster-only-mobile` does not trigger either branch.
- [ ] Existing app-nav rendering on `parts/header-app.html` is unchanged.
