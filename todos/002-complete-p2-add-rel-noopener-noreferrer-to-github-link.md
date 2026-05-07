---
status: complete
priority: p2
issue_id: "001"
tags: [code-review, security, html]
dependencies: []
---

# Add rel="noopener noreferrer" to external GitHub link in footers

## Problem Statement

Both footer parts contain an external link to `https://github.com/makyrie/orbit` without `rel="noopener noreferrer"`:

- `parts/footer-app.html:25` (added in this PR).
- `parts/footer-marketing.html:29` (pre-existing).

Same-tab navigation reduces tabnabbing risk, but `noreferrer` is still recommended for privacy hygiene on external links so the destination doesn't receive the originating URL via the `Referer` header.

## Proposed Solution

Add `rel="noopener noreferrer"` to both `<a>` tags by hand. Block markup `<a>` elements written directly inside `wp:list-item` are not auto-rewritten by core, so the attribute must be added manually:

```html
<a href="https://github.com/makyrie/orbit" rel="noopener noreferrer">GitHub</a>
```

## Acceptance Criteria

- [ ] `parts/footer-app.html` GitHub link includes `rel="noopener noreferrer"`.
- [ ] `parts/footer-marketing.html` GitHub link includes `rel="noopener noreferrer"`.
- [ ] Block-editor renders both footer parts without validation warnings.
- [ ] Front-end output of both footers contains the expected `rel` attribute.
