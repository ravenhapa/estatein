# Estatein Local Setup

## Option 1: Existing WordPress Install

1. Copy the `estatein` folder into `wp-content/themes/`.
2. In WordPress Admin, go to Appearance > Themes and activate Estatein.
3. Go to Settings > Permalinks and click Save Changes.
4. Create pages with these slugs:
   - `home`
   - `about`
   - `services`
   - `contact`
5. Set the Home page as the static front page under Settings > Reading.
6. Create a Primary Menu with Home, About Us, Properties, Services, and Contact Us.
7. Add Properties, Services, Team Members, Testimonials, and FAQs from the WordPress dashboard.

## Option 2: Docker Local Demo

From the project root:

```bash
docker compose up -d
```

Then open:

```text
http://localhost:8080
```

The Docker setup includes a MySQL `db` service and a `wordpress` service. WordPress connects to MySQL through `WORDPRESS_DB_HOST=db:3306`, and the database is stored in the `db_data` Docker volume. The WordPress files/uploads are stored in the `wp_data` volume, while the local `estatein` theme folder is mounted into `wp-content/themes/estatein`.

If Docker Desktop is installed but the `docker` command is not in your terminal PATH, use:

```bash
/Applications/Docker.app/Contents/Resources/bin/docker compose up -d
```

Complete the WordPress installer, activate the Estatein theme, and follow the content setup steps above.

## Recommended Content Entry

- Add at least three Properties and mark them as featured.
- Add four Services for the homepage quick links and service grid.
- Add three Testimonials and three FAQs.
- Add Team Members for the About page.
- Use optimized property images around 1600px wide or smaller before uploading.

## QA Checklist

- Header navigation works on desktop and mobile.
- Contact and property inquiry forms submit and redirect with a confirmation message.
- Properties archive and single property pages load.
- Search form returns matching content.
- Layout is checked at mobile, tablet, and desktop widths.
- Images have meaningful alt text.
- Keyboard focus is visible through navigation and forms.
