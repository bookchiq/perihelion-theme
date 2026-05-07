---
status: complete
priority: p3
issue_id: "015"
tags: [code-review, performance, php, micro-optimization]
dependencies: []
---

# Reorder `is_user_logged_in()` before `current_user_can()` in filter

## Problem Statement

In `functions.php:191, 195` the filter calls `current_user_can(...)` before (or alongside) `is_user_logged_in()`. `is_user_logged_in()` is essentially a global-state check; `current_user_can()` walks the role/cap maps. For anonymous requests, putting the auth check first lets the predicate short-circuit earlier. The perf delta is negligible — only worth flagging if you're already touching this filter for todos 008 / 012.

## Proposed Solution

When editing the filter for related todos, reorder the conditions so `is_user_logged_in()` runs first:

```php
if ( is_user_logged_in() && str_contains( $class_name, 'is-authenticated-only' ) ) { ... }
```

Skip if not already touching the filter — the gain is too small to justify a standalone change.

## Acceptance Criteria

- [ ] If touched: `is_user_logged_in()` is evaluated before role/cap checks in the nav filter.
- [ ] No behavior change.
- [ ] If not touched alongside todos 008/012: this todo can be closed as won't-do.
