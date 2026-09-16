# LUMORA — Contemporary Real Estate Landing Page

A contemporary cinematic landing page for LUMORA, a premium real estate brand focused on distinctive architecture, considered spaces, and exceptional properties.

## Overview

LUMORA is a modern real-estate landing page concept designed around cinematic property photography, strong typography, editorial layouts, and a refined architectural visual language.

The experience combines immersive imagery with clear navigation, property showcases, agency information, editorial insights, and contact-focused calls to action.

## Features

- Full-screen cinematic property hero
- Interactive 3-slide property slider
- Responsive navigation
- Featured property showcase
- Editorial agency/about section
- Full-width architectural image break
- Magazine-style insights section
- Contact CTA
- Responsive footer
- Smooth anchor navigation
- Keyboard-accessible slider controls
- Touch/swipe slider support
- Reduced-motion support
- Responsive layouts for desktop, tablet, and mobile

## Design Direction

The visual system uses a contemporary architectural aesthetic with:

- Charcoal and deep-black foundations
- Cool white and soft gray surfaces
- Restrained blue-gray accents
- Space Grotesk display typography
- Inter body typography
- Cinematic architectural photography
- Strong editorial typography
- Asymmetric layouts
- Subtle glass effects
- Minimal pill-shaped controls

## Technology

- WordPress
- Elementor Free
- Hello Elementor
- Custom WordPress child theme
- Vanilla JavaScript
- CSS
- Google Fonts
- Local WordPress Media Library assets

## WordPress Setup

- WordPress 7.1
- PHP 8.2.29
- nginx 1.26.1
- MySQL 8.4.0
- Elementor Free 4.2.4
- Hello Elementor 3.5.1

## Project Structure

```text
lumora-test/
├── app/
│   └── public/
│       └── wp-content/
│           └── themes/
│               └── lumora-test-child/
│                   ├── style.css
│                   ├── functions.php
│                   └── assets/
│                       ├── css/
│                       │   └── nova.css
│                       └── js/
│                           └── nova-slider.js
├── README.md
└── .gitignore
```

## Page Structure

A single landing page built with Elementor Free (Containers, Canvas template) and an
in-page header/footer:

- Fixed glass header with anchor navigation
- Full-bleed 3-slide cinematic hero (Sydney, Melbourne, Brisbane)
- Asymmetric featured property showcase
- Dark editorial agency section with statistics
- Full-width architectural image break
- Magazine-style insights section
- Dark contact call to action
- Premium black footer with contact details and social links

Content is stored in Elementor document data via the Elementor Document API, so the
page remains fully editable in Elementor Free. Theme header and footer output is
bypassed on the Canvas template.

## Media

Architectural photography is stored locally in the WordPress Media Library with
WordPress-generated responsive images. No external hotlinking. Frontend asset URLs are
served root-relative so the site also resolves correctly through Local Live Links.

## Accessibility

- Semantic landmarks with a single H1
- Slider wired with carousel ARIA roles, slide labels, and `aria-current` pagination
- Keyboard arrow navigation and visible focus states
- Skip link, descriptive alt text, and labelled social links
- Autoplay, motion effects, and scroll reveals honour `prefers-reduced-motion`

## Run Locally

1. Open the site in Local (PHP 8.2.29, MySQL 8.4.0).
2. Visit the homepage to view the LUMORA landing page.
3. Edit via WP Admin → Pages → LUMORA → Edit with Elementor.
4. After programmatic content changes: Elementor → Tools → Regenerate Files.
