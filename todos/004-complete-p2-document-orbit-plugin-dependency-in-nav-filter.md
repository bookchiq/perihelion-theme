---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, dependencies, documentation, php]
dependencies: []
---

# Document orbit plugin dependency in app-nav list-item filter

## Problem Statement

`functions.php:195` calls `current_user_can( 'orbit_create_activity' )` to decide whether to show poster-only nav items. That capability is registered by the orbit plugin. When the plugin is deactivated, the check returns false for everyone — including admins — and poster-only items vanish silently with no theme-side error.

Graceful degradation is acceptable behavior, but the dependency is undocumented. A future maintainer reading `functions.php` has no signal that the filter relies on a plugin-provided capability.

## Proposed Solution

Update the docblock at `functions.php:168` to call out the plugin dependency explicitly. Example:

```php
/**
 * Filter app-nav list items by visibility class.
 *
 * Hides items marked `is-authenticated-only` from logged-out visitors, and
 * hides items marked `is-poster-only` from users who lack the
 * `orbit_create_activity` capability.
 *
 * Note: `orbit_create_activity` is registered by the Orbit plugin. When the
 * plugin is deactivated, poster-only items are hidden from all users
 * (including admins). This is intentional graceful degradation.
 */
```

Optional follow-up: add a `function_exists()` or `is_plugin_active()` guard that falls through to `current_user_can( 'manage_options' )` so admins still see poster-only items when the plugin is deactivated.

## Acceptance Criteria

- [ ] The docblock at `functions.php:168` describes the `orbit_create_activity` capability dependency.
- [ ] The docblock describes the plugin-deactivated behavior (items hidden for everyone).
- [ ] Optional: a guard exists so admins see poster-only items when the orbit plugin is deactivated.
