---
status: complete
priority: p3
issue_id: "013"
tags: [code-review, design, theme]
dependencies: []
---

# Anonymous app header is visually sparse

## Problem Statement

After the nav filter runs, anonymous visitors on `/@sarah/` see only the Site title plus a Log in link. The right side of the header has a single nav item that may look stranded next to the centered wordmark. This is intentional (minimal anonymous chrome) but worth a deliberate design decision.

**File:** `parts/header-app.html`.

## Proposed Solution

Two options:

- Add a public-only nav item (e.g. an "About" link to `/why/`) so the right side has more weight when anonymous.
- Accept the sparse look as a deliberate "minimal anonymous chrome" choice and document it.

Either is reasonable. Choose based on visual review of the header in an anonymous browser session.

## Acceptance Criteria

- [ ] Decision documented: add a public nav item, or accept the sparse layout.
- [ ] If a public item is added: it renders for anonymous visitors only and balances the header visually.
- [ ] No regression for authenticated/poster header rendering.
