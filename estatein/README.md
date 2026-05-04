# Estatein WordPress Theme

Estatein is a custom dark real estate WordPress theme built from scratch for property agencies, brokers, and real estate service teams.

## Installation

1. Move the `estatein` folder into `wp-content/themes/`.
2. In WordPress Admin, go to Appearance > Themes and activate Estatein.
3. Go to Settings > Permalinks and save once if the `/properties/` archive does not load immediately.
4. Create pages for Home, About, Services, and Contact. Use the slugs `home`, `about`, `services`, and `contact`.
5. Set the Home page as the static front page in Settings > Reading.
6. Add listings under Properties. Each property supports price, address, beds, baths, area, label, featured image, and a featured toggle.

## Theme Features

- Custom `property` post type with `/properties/` archive.
- Property type and property status taxonomies.
- Custom post types for Services, Team Members, Testimonials, and FAQs.
- Optional Advanced Custom Fields local field groups when ACF is installed.
- Built-in fallback meta boxes when ACF is not installed.
- Responsive dark homepage inspired by the Estatein design direction.
- Property archive, single property, About, Services, Contact, page, post, search, and 404 templates.
- Lightweight lead forms that send inquiries to the WordPress admin email.
- Fallback demo properties so the homepage is presentable before content entry.
- Reusable header, footer, sidebar, and card template parts.
- Basic SEO meta tags, lazy-loaded images, visible focus states, and mobile navigation.

## Recommended Setup

- Add a Primary Menu with Home, About Us, Properties, Services, and Contact Us.
- Use high-quality property photos as featured images on Property posts.
- Mark three Property posts as featured to replace the fallback demo cards on the homepage.
- Add four Service posts, three Testimonial posts, three FAQ posts, and Team Member posts for fully editable homepage and About content.

## Local Demo

This repository includes a Docker setup at the project root. Run `docker compose up -d`, then open `http://localhost:8080` and activate the Estatein theme.

More details are available in `docs/local-setup.md` and `docs/development-process.md`.
