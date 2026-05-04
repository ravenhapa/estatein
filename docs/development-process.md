# Estatein Development Process

## Project Approach

Estatein was developed as a custom WordPress theme from scratch using PHP, CSS, and a small amount of JavaScript. The implementation follows the supplied Figma direction and Estatein reference structure: dark real estate visual system, prominent homepage hero, property discovery cards, service sections, testimonials, FAQs, About content, Services content, Contact form, property archive, and property detail pages.

The theme is intentionally lightweight. It does not depend on a page builder, large JavaScript framework, or heavy visual plugin. Core WordPress templates and custom post types provide the editing experience, while reusable template parts keep repeated cards consistent across pages.

## Theme Structure

All custom theme files live under `wordpress/wp-content/themes/estatein/`, matching the conventional WordPress theme location.

- `header.php`, `footer.php`, and `sidebar.php` provide reusable layout components.
- `front-page.php`, `page-about.php`, `page-services.php`, and `page-contact.php` cover the primary Figma/reference pages.
- `archive-property.php` and `single-property.php` power listing discovery and detail views.
- `index.php`, `single.php`, `search.php`, and `404.php` provide WordPress blog, search, and fallback coverage.
- `template-parts/` contains reusable property, service, team, testimonial, and FAQ cards.
- `inc/` contains custom content registration, optional ACF fields, and fallback meta boxes.

## Content Management

The theme targets current classic-theme WordPress APIs and has its theme header updated for WordPress 6.9.4, the latest stable release listed in the WordPress release archive at the time of this pass. WordPress 7.0 was still in pre-release/delayed status, so it is not treated as the production baseline.

The theme registers these editable WordPress content sections:

- Properties
- Services
- Team Members
- Testimonials
- FAQs

Properties include fields for price, address, beds, baths, area, listing label, and featured status. Services, Team Members, and Testimonials also include lightweight custom fields.

Advanced Custom Fields is optional. If ACF is installed, the theme registers local field groups for a cleaner editing interface. If ACF is not installed, the theme provides built-in meta boxes so the site remains fully usable without extra plugins.

## UX, Accessibility, and Responsiveness

The layout uses responsive CSS grids, fixed card ratios, mobile navigation, clear focus states, a skip link, semantic landmarks, accessible labels, and sufficient contrast for the dark visual system. Forms use labels and nonce validation. Buttons and cards include hover/focus states without relying on motion for comprehension.

## SEO and Performance

The theme supports WordPress title tags, basic meta descriptions, Open Graph title/description tags, lazy-loaded non-critical images, responsive featured image sizes, minimal JavaScript, and no render-heavy dependencies. Production deployments can add a caching/minification plugin at the hosting layer without changing the theme.

## Plugin Choices

No plugin is required for the submitted theme to function. ACF is supported as an optional enhancement for field management. A dedicated form plugin can be added later if the client needs CAPTCHA, CRM integration, or advanced spam filtering.

## Testing Notes

PHP syntax checks were run across all theme PHP files. `theme.json` was validated as JSON. Browser/device testing should be completed inside a WordPress environment using the local setup in `docs/local-setup.md`, with Chrome, Firefox, Safari, Edge, and mobile/tablet viewport checks.
