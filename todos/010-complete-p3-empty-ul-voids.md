---
status: complete
priority: p3
issue_id: "010"
tags: [code-review, css, html, polish]
dependencies: []
---

# Empty `<ul>` voids from filtered nav items

## Problem Statement

In `functions.php:192, 196` the filter returns `''` for stripped list items, which removes the `<li>` but leaves the surrounding `<ul>` intact with blank lines where items used to be. For an anonymous + non-poster visitor, every item except `loginout` is stripped — the `<ul>` is sparse but never empty. This is cosmetic only; in practice the `<ul>` always retains at least the loginout item.

## Proposed Solution

Two options:

- Accept as-is. The list is never truly empty in practice, and stripped `<li>` elements collapse cleanly in the rendered DOM.
- Filter at `render_block_core/list` to drop the `<ul>` wrapper when only `loginout` remains.

Recommendation: accept. There is no real empty-list edge case and the added filter complexity isn't justified by the cosmetic benefit.

## Acceptance Criteria

- [ ] Decision recorded: accept current behavior, or implement wrapper-drop filter.
- [ ] If wrapper-drop is chosen: the `<ul>` is removed when its only remaining child would be the loginout item.
- [ ] No regression for any role/auth combination on the front end.
