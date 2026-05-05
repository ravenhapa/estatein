# Estatein Local Deployment README

This document explains how to run the Estatein project locally for review, testing, or demo purposes using Docker Compose.

This is a local development/demo setup, not a production deployment guide.

## Project Requirements

Before starting, make sure your machine has:

- Docker Desktop installed and running
- Git installed

If you are on macOS, open `Docker.app` and wait until Docker is fully running before using the terminal commands below.

## Project Structure

The local setup depends on this project structure:

- `docker-compose.yml`
- `wordpress/`
- `wordpress/wp-content/themes/estatein/`

Run all commands from the project root where `docker-compose.yml` is located.

## 1. Clone Or Open The Project

If you have not downloaded the project yet:

```bash
git clone YOUR_REPO_URL
cd YOUR_PROJECT_FOLDER
```

If you already have the project, open the root folder in your terminal.

## 2. Start The Local Site

Run:

```bash
docker compose up -d
```

This starts:

- a MySQL database container
- a WordPress container

## 3. Open The Site

After the containers start, open:

```text
http://localhost:8080
```

If WordPress is loading for the first time, complete the normal WordPress installation flow in the browser.

## 4. Activate The Theme

In WordPress Admin:

1. Go to `Appearance > Themes`
2. Activate `Estatein`

## 5. Complete WordPress Setup

After activating the theme:

1. Go to `Settings > Permalinks`
2. Click `Save Changes`
3. Go to `Settings > Reading`
4. Set the homepage to a static page if needed

Create these pages if they are missing:

- `Home`
- `About`
- `Services`
- `Contact`

Then create a navigation menu with:

- Home
- About Us
- Properties
- Services
- Contact Us

## 6. Add Demo Content

To make the site look complete, add content for:

- Properties
- Services
- Team Members
- Testimonials
- FAQs

Recommended minimum content:

- 3 Properties
- 4 Services
- 4 Team Members
- 3 Testimonials
- 3 FAQs

## Docker Commands

Start containers:

```bash
docker compose up -d
```

Stop containers:

```bash
docker compose down
```

Restart containers:

```bash
docker compose restart
```

See running containers:

```bash
docker compose ps
```

See logs:

```bash
docker compose logs wordpress
docker compose logs db
```

Pull new code and restart:

```bash
git pull
docker compose up -d
```

## Common Issues

### `docker: command not found`

Docker is either not installed or not available in your terminal session.

On macOS:

1. Install Docker Desktop
2. Open `Docker.app`
3. Wait until Docker is running
4. Open a new terminal window

Then try:

```bash
docker --version
docker compose version
```

### Docker Desktop Is Installed But Terminal Still Cannot Find Docker

Try:

```bash
/Applications/Docker.app/Contents/Resources/bin/docker compose up -d
```

### Site Does Not Open

Check:

```bash
docker compose ps
docker compose logs wordpress
docker compose logs db
```

Make sure Docker Desktop is still running.

### Theme Does Not Show

Make sure the theme exists at:

```text
wordpress/wp-content/themes/estatein
```

Then activate it in:

```text
Appearance > Themes
```

### Pretty URLs Like `/about/` Or `/properties/` Do Not Work

Go to:

```text
Settings > Permalinks
```

and click:

```text
Save Changes
```

This refreshes WordPress rewrite rules.

## Local Deployment Checklist

- Docker Desktop installed
- Docker Desktop running
- Project opened from the repo root
- `docker compose up -d` completed successfully
- Site loads at `http://localhost:8080`
- Estatein theme activated
- Permalinks saved
- Pages created
- Front page assigned
- Demo content added
