---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, accessibility, css]
dependencies: []
---

# Mark dot separators as decorative for screen readers

## Problem Statement

`assets/css/custom.css:84-90` uses `content: "·"` in a `::before` pseudo-element to render dot separators between footer links. Some screen readers (NVDA, VoiceOver iOS) announce this character as "middle dot" between every list item, adding noise to the reading experience.

## Proposed Solution

Use the CSS3 alt-text syntax to mark the pseudo-element's content as decorative:

```css
.perihelion-footer-app__links li:not(:first-child)::before {
    content: "·" / "";
    /* existing properties */
}
```

The `/ ""` portion provides empty alt text, instructing screen readers to skip the pseudo-element. Modern browsers support this; older browsers fall back to announcing the character — acceptable progressive enhancement.

## Acceptance Criteria

- [ ] The `::before` rule for footer-link separators uses `content: "·" / ""` syntax.
- [ ] Visual rendering of the separators is unchanged in current Chrome, Firefox, and Safari.
- [ ] VoiceOver (macOS) does not announce the separator characters when reading the footer link list.
