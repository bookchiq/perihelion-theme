---
status: complete
priority: p3
issue_id: "011"
tags: [code-review, documentation, php]
dependencies: []
---

# Filter scope is undocumented

## Problem Statement

The `render_block` filter at `functions.php:168-186` only fires on `core/list-item` blocks. The same `is-authenticated-only` / `is-poster-only` classNames applied to `core/paragraph` or `core/group` would not be filtered. That scoping is intentional (these are list-item-only conventions for the app header nav) but it is not documented in the filter's docblock, which could confuse future maintainers who try to reuse the classNames elsewhere.

## Proposed Solution

Add a one-line note to the filter's docblock clarifying that the `is-authenticated-only` and `is-poster-only` classNames are list-item-only conventions used by the app header nav, and that applying them to other block types will not have any effect.

## Acceptance Criteria

- [ ] Docblock for the filter callback explicitly states the classNames apply only to `core/list-item` blocks in the app header context.
- [ ] No code behavior change.
