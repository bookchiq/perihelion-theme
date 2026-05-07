---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, css, gutenberg, block-styles]
dependencies: []
---

# Extend footer-links block style instead of overriding via utility class

## Problem Statement

`assets/css/custom.css:71-90` defines `.perihelion-footer-app__links`, which redeclares `display`, `padding`, and adds `::before` separators. These rules fight `is-style-footer-links`'s base rules (`padding: 0.25em 0` on `li`) instead of composing with them. The result: one block style with two different layouts based on whether a custom utility class is present.

This couples block-style identity to a hand-applied utility class and makes the intent of each rule unclear at a glance.

## Proposed Solution

Two options, in preference order:

**Option A (cleaner long-term).** Register a separate `is-style-footer-links-inline` block style for horizontal use, parallel to the existing `is-style-app-nav` and `is-style-footer-links` styles. Apply that style on the app footer's link list via the block-style picker. Drop the `.perihelion-footer-app__links` utility class.

**Option B (faster).** Keep the override but raise specificity to `.is-style-footer-links.perihelion-footer-app__links` so the intent is explicit — the existing rules at lines 57-65 stay the default, and the override only applies when both classes are present.

## Acceptance Criteria

- [ ] One of the two options is implemented.
- [ ] If Option A: a new `is-style-footer-links-inline` block style is registered and applied on the app footer link list.
- [ ] If Option A: the `.perihelion-footer-app__links` utility class is removed from CSS and from `parts/footer-app.html`.
- [ ] If Option B: the override selector is `.is-style-footer-links.perihelion-footer-app__links` (or equivalent).
- [ ] App footer link layout is visually unchanged from the current PR output.
- [ ] Marketing footer link layout is unaffected.
