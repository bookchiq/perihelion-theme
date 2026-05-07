---
status: complete
priority: p3
issue_id: "012"
tags: [code-review, php, modernization]
dependencies: []
---

# Use `str_contains()` over `false !== strpos()`

## Problem Statement

In `functions.php:191, 195` the filter uses `false !== strpos( $class_name, '...' )` to test for substring matches. The theme requires PHP 8.0 per `style.css`, where `str_contains()` is available and reads more clearly than the `false !== strpos()` workaround.

## Proposed Solution

Replace the `false !== strpos(...)` checks with `str_contains(...)`:

```php
if ( str_contains( $class_name, 'is-authenticated-only' ) ) { ... }
if ( str_contains( $class_name, 'is-poster-only' ) ) { ... }
```

This combines naturally with the word-boundary fix in todo 008 — both touch the same lines.

## Acceptance Criteria

- [ ] `false !== strpos(...)` calls in the nav filter are replaced with `str_contains(...)`.
- [ ] No behavior change beyond what todo 008 introduces.
- [ ] Theme's stated minimum PHP version (8.0) remains accurate.
