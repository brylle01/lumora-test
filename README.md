# LUMORA Test, Contemporary Cinematic Concept (second interpretation)

Second, fully independent interpretation of the LUMORA real-estate landing-page brief.
Brand on the site remains **LUMORA, Real Estate**; `lumora-test` is only the local
project/site identifier. The first submission under `~/Local Sites/lumora` was used as a
**technical reference only** and remains untouched.

## Stack (verified local)

- WordPress 7.1 · PHP 8.2.29 · nginx 1.26.1 · MySQL 8.4.0 (Local)
- Parent theme: Hello Elementor 3.5.1 (unmodified)
- Child theme: `lumora-test-child` 1.1.0 (this project, `nova-` namespaced brand layer)
- Page builder: Elementor Free 4.2.4, Containers only, Canvas template
- Site URL (Local): http://localhost:10008/ · http://lumora-test.local (if mapped)

## What is tracked in git (when initialised, NOT committed yet)

Only project files, never core, secrets, or generated content:

- `app/public/wp-content/themes/lumora-test-child/` (style.css, functions.php,
  assets/css/nova.css, assets/js/nova-slider.js)
- `README.md`, `.gitignore`, `docs/` (if present)

## Structure

- Page ID 14, title `LUMORA`, slug `lumora-nova-home`, template `elementor_canvas`,
  set as homepage (`show_on_front=page`, `page_on_front=14`). Content lives in
  `_elementor_data` via the Elementor Document API (plus `set_is_built_with_elementor(true)`
  so the builder markup renders), fully editable in Elementor Free.
- Zones 00-07: fixed glass header → full-bleed 3-slide hero → asymmetric properties →
  dark About → full-width image break → magazine insights → dark CTA → black footer.
- Anchors `$main/#properties/#about/#insights/#contact` via empty-span anchor widgets.
- Design tokens: ink `#0B0F14`, black `#070A0E`, paper `#F2F5F7`, cool gray `#D8DEE3`,
  accent `#7C9BB5` / deep `#526B7D` / highlight `#A9C4D8`, muted `#8C969F`.
  Display `Space Grotesk`, body/nav `Inter` (Google Fonts, system fallbacks).
  Cool charcoal + cool white + blue-gray architectural identity (no bronze).

## Run locally

1. Open the site in Local (PHP 8.2.29, MySQL socket `.../run/<id>/mysql/mysqld.sock`).
2. Frontend: http://localhost:10008/ (homepage = LUMORA).
3. Edit: WP Admin → Pages → LUMORA → **Edit with Elementor**.
4. After programmatic changes: Elementor → Tools → Regenerate Files (or `wp elementor flush-css`).

## Rebuilding the page programmatically

Populated via `Document::save(['elements'=>..., 'settings'=>...])` with
`wp_set_current_user(1)` (CLI has no user; save returns false otherwise) and
`set_is_built_with_elementor(true)` (otherwise frontend falls back to plain markup).
Never write `_elementor_data` with raw SQL. Backup `wp_posts`/`wp_postmeta` before re-running.

## Images

Fresh `iso-` prefixed cinematic architecture set from Unsplash (Unsplash License),
downloaded to the Media Library (IDs 27–37: concrete/steel residences, glass facades,
coastal villa, cool interiors) — not committed to git. No hotlinking (local `srcset` URLs,
relativized for Live Link safety via `nova_` URL filters). No shared assets with the
first `lumora` project (separate files, IDs, and URLs).

## Responsive / QA

Full-bleed hero + asymmetric grids with breakpoints at 1024 / 768, `overflow-x: clip`
guard, focus-visible states, `prefers-reduced-motion` support (kills autoplay, Ken Burns,
reveal). Verified in headless Chrome at 1440 / 1024 / 390: slider autoplay/next/dots/
keyboard, sticky header + anchors, single H1, alt text, zero console errors, no
horizontal overflow, zero absolute localhost asset URLs.
