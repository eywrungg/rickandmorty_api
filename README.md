# Rick and Morty Field Guide

A Laravel-based Rick and Morty explorer that turns the public API into a more curated web experience with authentication, OTP registration, favorites, episode browsing, and a redesigned responsive UI.

## What This Project Is

This app is a fan-facing explorer for the Rick and Morty universe. Instead of a plain demo shell, it gives users:

- a public landing page
- login and OTP-backed registration
- a dashboard with live API stats
- character browsing and detail views
- episode browsing and episode cast views
- a favorites system tied to authenticated users
- profile and password-management flows

## Tech Stack

- PHP 8.2
- Laravel 12
- Blade templates
- Laravel UI authentication scaffolding
- Tailwind CSS v4 through Vite
- Bootstrap JS bundle import
- MySQL or compatible relational database
- Rick and Morty API as the external data source

## Documentation

Full project documentation lives in [PROJECT_DOCUMENTATION.md](./PROJECT_DOCUMENTATION.md).

It includes:

- project overview
- feature inventory
- route and controller breakdown
- data model summary
- UI/design system notes
- security notes
- setup instructions
- improvements made in this redesign
- next-step recommendations

## Local Setup

1. Install PHP and Node dependencies.
2. Copy `.env.example` to `.env` if needed.
3. Configure your database and mail settings in `.env`.
4. Run migrations.
5. Start Laravel and Vite.

### Commands

```bash
composer install
npm install
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

For a production asset build:

```bash
npm run build
```

## Main Improvements In This Version

- replaced the default README with real project documentation
- redesigned the UI into a shared Rick and Morty-inspired visual system
- introduced a custom monochrome icon set instead of generic colored icons
- improved responsive navigation and page consistency
- moved frontend styling into shared Vite-managed assets
- centralized external API calls into `RickAndMortyApiService`
- added or improved caching for stats, characters, episodes, and batch lookups
- removed the old one-request-per-favorite lookup pattern

## Notes

- registration depends on mail delivery because OTP codes are emailed
- favorites require authentication
- character and episode data come from the external Rick and Morty API
