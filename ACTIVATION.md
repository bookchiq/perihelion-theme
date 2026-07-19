# Activating the Perihelion Theme

After this branch lands and the theme directory is in place at
`wp-content/themes/perihelion/`, here's how to bring it to life.

## 1. Activate the theme

In WP admin → **Appearance → Themes**, find Perihelion and click **Activate**. Or via WP-CLI:

```bash
wp theme activate perihelion
```

You should immediately see the cream-paper background, Sienna links, and Fraunces+Inter typography render across all pages.

## 2. Set the front page

Out of the box, WordPress will show your latest blog posts on the front page. To use the Perihelion home composition:

- WP admin → **Settings → Reading**
- "Your homepage displays" → **A static page**
- Front page → create or pick a page (e.g., "Home"); content can be left blank because `front-page.html` doesn't read it
- Save

The front page now renders the assembled patterns: hero, audience mirror, how it works, what's different, closing CTA.

## 3. Publish the canonical pages

Deploy and activate Orbit before the theme. Orbit creates and updates these code-owned pages during its version-aware upgrade:

- **Why this exists** (`why`)
- **Contact** (`contact`)
- **Privacy Policy** (`privacy`)
- **Terms of Service** (`terms`)
- **Sign Up** (`sign-up`)

Do not maintain alternate copies in the editor. Orbit refuses to overwrite unrelated pages that occupy one of these slugs and reports the collision for manual reconciliation.

## 4. Assign the App template to plugin pages

The 8 app pages created by the orbit plugin (Dashboard, Settings, Subscriptions, Manage, New Activity, Edit Activity, Subscribers, Edit Profile) should use the wider **App layout** template instead of the default narrow editorial one.

**Until the plugin patch lands** (a separate small PR will assign this automatically), do this manually:

For each of the 8 pages, edit it in WP admin, open the Page Attributes panel in the sidebar, and set Template → **App layout**. Save.

This makes the plugin's dashboards and forms render in the 1080px-wide layout instead of the 720px reading column.

## 5. Set the site title

WP admin → **Settings → General** → Site Title → "Perihelion" (or whatever you want the wordmark to read). The theme's site-title block reads from this. You can also set the tagline here, though the theme doesn't currently render it.

## 6. (Optional) Build a navigation menu

The app header includes a default in-template navigation (Dashboard / Subscriptions / Manage / Subscribers / Settings). The marketing header includes a single Sign in / Dashboard link.

If you want to customize either, edit the corresponding template part in **Appearance → Editor → Patterns → Template parts** (`Header (marketing)` or `Header (app)`).

## 7. Verify visually

Open these URLs and confirm:

- `/` → Home (front-page.html with all 5 patterns assembled)
- `/why/` → narrow editorial column with prose
- `/privacy/` → same template, your privacy copy
- `/dashboard/` → after switching template to "App layout," the wider layout with the plugin's `[orbit_dashboard]` shortcode rendered
- Any random non-existent URL (e.g., `/asdf/`) → friendly 404 page with "Take me home" button
- `/wp-login.php` → branded login screen with the Fraunces wordmark

## 8. Things that need follow-up plugin work

Logged here so they don't get lost:

- **`_wp_page_template` post-meta on the 8 app pages** — small patch to `Orbit_Activator::create_pages()` and `orbit_migrate_page_slugs()` to set this automatically. Until then, manual assignment per Step 4.
- **Actionable workflow indicator** (pending-subscriber count badge) — currently lives only in the plugin's shortcode-rendered chrome inside the activity/dashboard markup. The theme's `header-app.html` renders the nav links but doesn't display a count badge next to "Subscribers." Adding this will require a small plugin hook the theme can read from, or a small REST call from theme JS. Out of scope for the initial scaffold.

## Known visual issues at this stage

- Without the plugin's app-template assignment (Step 4 manual workaround), the plugin's dashboards may feel cramped at the 720px reading width.
- The site-title block on a fresh install may show "Just another WordPress site" tagline beneath it. Either set the tagline in Settings → General to something appropriate, or leave it (the marketing header template doesn't render the tagline by default).
- No favicon / site icon is set. Add one in **Settings → General → Site Icon** if desired.
