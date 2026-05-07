---
status: complete
priority: p3
issue_id: "014"
tags: [code-review, naming, documentation]
dependencies: []
---

# Behavioral classes co-located with style classes

## Problem Statement

In `parts/header-app.html`, the classNames `is-authenticated-only` and `is-poster-only` are role-based behavioral hooks consumed by the PHP `render_block` filter — they don't drive any styling. They sit alongside style classes like `is-style-app-nav` on the same elements. Co-location is acceptable (WP core does this too) but a future maintainer reading the markup may not realize these are behavioral classes coupled to PHP, not stylistic ones.

## Proposed Solution

Three options:

- Rename to `orbit-auth-only` / `orbit-poster-only` — the `orbit-` prefix signals plugin-coupled behavior.
- Add an HTML comment near the top of the `<ul>` referencing the `functions.php` filter so the coupling is discoverable from the markup.
- Accept the convention as-is (it matches the pre-existing `is-poster-only` pattern).

Recommendation: accept and add an HTML comment near the top of the `<ul>` pointing to the filter in `functions.php`.

## Acceptance Criteria

- [ ] Decision recorded: keep classNames as-is (with comment), or rename.
- [ ] If keeping: an HTML comment near the `<ul>` references the `functions.php` filter so the behavioral coupling is discoverable.
- [ ] If renaming: filter and template are updated together and tested for all role/auth combinations.
