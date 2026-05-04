# AGENTS.md

## Project Overview

Estatein is a custom WordPress theme project based on a dark real estate Figma design. The primary goal is to convert the reference design into a complete, responsive WordPress website with strong fidelity to the provided layouts, typography, color system, spacing, content hierarchy, and interaction patterns.

The theme source lives in `wordpress/wp-content/themes/estatein/`. Project documentation lives in `docs/`. A Docker-based local WordPress setup is available through `docker-compose.yml`.

## Primary Objectives

- Build and maintain Estatein as a custom WordPress theme using PHP, HTML, CSS, and minimal JavaScript.
- Replicate all pages represented in the reference as completely as possible, including home, about, properties, services, contact, blog/search, property detail, and fallback pages.
- Keep the site fully responsive across mobile, tablet, and desktop.
- Implement functional navigation, forms, buttons, hover states, focus states, and mobile menu behavior.
- Keep the codebase clean, readable, documented where helpful, and aligned with WordPress best practices.

## WordPress Requirements

- Use standard WordPress template hierarchy and APIs.
- Keep reusable layout pieces in theme components such as `header.php`, `footer.php`, `sidebar.php`, and `template-parts/`.
- Use the WordPress Loop for posts, archives, search results, and custom post type output.
- Preserve compatibility with current stable WordPress APIs.
- Avoid heavy page builders or large frontend frameworks unless explicitly requested.
- Prefer theme-native functionality; plugins should be optional unless a feature truly requires one.

## Content Management

The client should be able to manage key site content from the WordPress dashboard.

Maintain support for:

- Properties
- Services
- Team Members
- Testimonials
- FAQs
- Blog posts
- Pages

Use Custom Post Types for structured content. Use Advanced Custom Fields when available for a polished editing interface, but preserve fallback meta boxes so the theme remains functional without ACF.

For properties, maintain editable fields for price, address, beds, baths, area, listing label, featured image, and featured status.

## Design And UX

- Match the Figma/reference design as closely as practical.
- Preserve the dark real estate visual language, strong hierarchy, card grids, purple accent system, and restrained rounded corners.
- Keep navigation intuitive and predictable.
- Ensure forms are easy to understand, properly labeled, and validated.
- Use hover and focus states for interactive elements.
- Do not add decorative or unrelated visual elements that reduce fidelity to the source design.
- Any creative enhancements should improve usability, clarity, or polish without drifting away from the reference.

## Responsiveness

- Use responsive CSS grids, flexible containers, media queries, and stable dimensions.
- Verify layouts at mobile, tablet, and desktop widths.
- Ensure text does not overlap, overflow buttons, or collide with adjacent content.
- Ensure images maintain useful crop/framing across breakpoints.
- Mobile navigation must be usable with keyboard and touch.

## Accessibility

- Use semantic landmarks and headings.
- Preserve a skip link.
- Ensure visible keyboard focus states.
- Provide meaningful image alt attributes.
- Use labels for form fields.
- Keep color contrast suitable for a dark theme.
- Do not rely on hover or animation alone to communicate meaning.

## SEO And Performance

- Use WordPress title-tag support and basic meta descriptions.
- Ensure images include alt text and use appropriate sizes.
- Lazy-load non-critical images.
- Keep JavaScript minimal and defer to WordPress enqueue APIs.
- Avoid unnecessary plugins, remote scripts, and heavy dependencies.
- Optimize for clean HTML, fast loading, and cache-friendly deployment.

## Testing Checklist

Before considering work complete, run or document:

- PHP syntax checks for all theme PHP files.
- `theme.json` JSON validation when edited.
- Basic responsive checks for mobile, tablet, and desktop.
- Navigation checks, including mobile menu behavior.
- Form submission checks for contact and property inquiry forms.
- Archive and single template checks for properties and posts.
- Search result checks.
- Link and button checks.
- Keyboard focus checks.

If a full browser or WordPress runtime is unavailable, clearly state what could not be tested and why.

## Local Demo

The project includes a Docker setup. To run locally:

```bash
docker compose up -d
```

Then open:

```text
http://localhost:8080
```

Activate the Estatein theme in WordPress Admin, create the recommended pages, set the static front page, and populate Properties, Services, Team Members, Testimonials, and FAQs.

## Documentation Deliverables

Keep handoff documentation current:

- `docs/development-process.md` should explain development choices, theme structure, content management, plugin strategy, UX/accessibility, SEO/performance, and testing notes.
- `docs/local-setup.md` should explain how to run the project locally and prepare demo content.
- `wordpress/wp-content/themes/estatein/README.md` should remain a practical theme installation and setup guide.

## Coding Conventions

- Use WordPress escaping, sanitization, nonces, and capability checks where appropriate.
- Use `wp_enqueue_style()` and `wp_enqueue_script()` for assets.
- Use reusable template parts instead of duplicating card markup.
- Keep edits scoped to the requested feature or requirement.
- Avoid unrelated refactors.
- Keep comments helpful and succinct.
- Prefer ASCII text in project files unless a file already requires otherwise.
