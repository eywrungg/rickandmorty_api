# Project Documentation

## 1. Project Overview

### Name
Rick and Morty Portal

### What It Is
This is a Laravel web application that uses the public Rick and Morty API to let users explore characters and episodes in a cleaner, more designed way than a default scaffolded project.

It combines:

- public marketing/landing pages
- authenticated exploration
- OTP-based registration
- saved favorites
- profile and password management
- responsive UI presentation

### Project Goal
The goal is to present Rick and Morty universe data as a polished, fan-friendly archive instead of a plain technical demo.

## 2. Core Features

### Public Features

- landing page at `/`
- login page
- register page with OTP verification
- password reset flow

### Authenticated Features

- dashboard
- character list with search and pagination
- character detail page
- episode list with filtering
- episode detail page with cast listing
- favorites page
- profile page
- password update from profile

## 3. Tech Stack

### Backend

- PHP 8.2
- Laravel 12
- Laravel UI
- Eloquent ORM
- Laravel session-based authentication
- Laravel mail system
- Laravel cache system
- Laravel HTTP client

### Frontend

- Blade templates
- Tailwind CSS v4
- Vite
- shared custom CSS design system in `resources/css/app.css`
- shared frontend interaction logic in `resources/js/app.js`

### External Service

- Rick and Morty API

### Data Storage

- relational database for users, favorites, cache, jobs, and OTP records

## 4. Architecture Summary

### Route Layer
Primary routes are defined in [routes/web.php](/C:/xampp/htdocs/RICKANDMORTY/routes/web.php).

The route file includes:

- public landing route
- Laravel auth routes
- OTP send endpoint
- authenticated dashboard route
- characters routes
- episodes routes
- favorites routes
- profile routes
- fallback route

### Controller Layer

- [DashboardController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/DashboardController.php)
  Handles dashboard stats and featured characters.

- [CharacterController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/CharacterController.php)
  Handles character listing and character details.

- [EpisodeController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/EpisodeController.php)
  Handles episode listing, filtering, pagination, and episode details.

- [FavoriteController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/FavoriteController.php)
  Handles add/remove favorite actions and the favorites page.

- [ProfileController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/ProfileController.php)
  Handles account display and password updates.

- [RegisterController.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Controllers/Auth/RegisterController.php)
  Handles OTP generation, email sending, validation, and account creation.

### Service Layer

- [RickAndMortyApiService.php](/C:/xampp/htdocs/RICKANDMORTY/app/Services/RickAndMortyApiService.php)

This service was introduced to centralize external API access. It now handles:

- stat retrieval
- character page retrieval
- single character retrieval
- batch character retrieval
- full episode archive retrieval
- single episode retrieval
- character resolution from episode character URLs

This is one of the biggest structural improvements in the redesign because it removes repeated API logic from controllers.

## 5. Data Model

### Users
Default Laravel users table for authentication.

### Favorites
Defined by [create_favorites_table.php](/C:/xampp/htdocs/RICKANDMORTY/database/migrations/2025_10_18_104040_create_favorites_table.php).

Fields:

- `id`
- `user_id`
- `character_id`
- `name`
- `image`
- timestamps

Purpose:

- stores which character IDs a user saved
- stores fallback name and image data

### Email OTPs
Defined by [create_emailotps_table.php](/C:/xampp/htdocs/RICKANDMORTY/database/migrations/2025_10_18_124020_create_emailotps_table.php).

Fields:

- `id`
- `email`
- `otp`
- `expires_at`
- timestamps

Purpose:

- temporarily stores OTP codes before registration completes

## 6. UI and Design System

### Visual Direction
The redesign shifts the project away from a generic glowing dashboard look and toward a modern Rick and Morty API portal.

The interface now uses:

- shared layout shell
- stronger typography hierarchy
- archive-card style panels
- monochrome custom icons
- restrained accent usage
- better whitespace and grouping
- responsive mobile navigation

### Palette Direction
The palette was refreshed around recognizable Rick and Morty colors rather than unrelated neon UI colors.

Research references:

- Rick and Morty portal color usage commonly centers green for interdimensional portals, with blue/purple and yellow/gold used for other portal types.
- Public Rick and Morty palettes consistently include turquoise, portal green, Morty yellow, Rick blue, brown, and navy.

Current app palette:

- Rick turquoise: `#01B4C6`
- Portal green: `#97CE4C`
- Morty yellow: `#FFF874`
- Rick blue: `#BEE5FD`
- Rick and Morty brown: `#44281D`
- Dark sci-fi navy: `#10212B`
- Error/dead state red: `#E64358`

The palette is implemented as CSS variables in [app.css](/C:/xampp/htdocs/RICKANDMORTY/resources/css/app.css), with matching Tailwind utility colors in the Blade views.

### Fonts
The redesign uses:

- `Outfit` for display headings and brand text
- `Manrope` for body and UI text
- `IBM Plex Mono` for metadata and labels

### Icon Strategy
The redesign avoids:

- default heroicons-only feel
- bright colored icons
- generic “AI sci-fi dashboard” icon styling

Instead it uses a custom Blade icon component:

- [icon.blade.php](/C:/xampp/htdocs/RICKANDMORTY/resources/views/components/ui/icon.blade.php)

These icons are line-based, monochrome, and more consistent with the project’s new art direction.

Status badges now use readable icons and solid color backgrounds:

- alive: pulse icon with portal green
- dead: skull icon with red
- unknown: question-diamond icon with turquoise

## 7. Frontend Structure

### Shared Layouts

- [app.blade.php](/C:/xampp/htdocs/RICKANDMORTY/resources/views/layouts/app.blade.php)
  Main layout for public and authenticated pages.

- [auth.blade.php](/C:/xampp/htdocs/RICKANDMORTY/resources/views/layouts/auth.blade.php)
  Shared layout for auth-oriented pages.

### Shared CSS

- [app.css](/C:/xampp/htdocs/RICKANDMORTY/resources/css/app.css)

This file now contains:

- theme variables
- base styling
- panel styles
- button styles
- card styles
- navigation styles
- auth styling
- responsive rules

### Shared JS

- [app.js](/C:/xampp/htdocs/RICKANDMORTY/resources/js/app.js)

This file now handles:

- mobile nav toggle
- favorite toggle interactions
- favorites count updates
- password visibility toggles
- password helper UI
- modal open/close helpers
- particle background seeding for auth pages

## 8. Security Notes

### Existing Security Measures

- CSRF protection via Laravel
- throttled OTP route
- throttled favorites toggle route
- throttled password update route
- password hashing
- session regeneration after login/registration
- custom security headers middleware

Relevant file:

- [SecurityHeaders.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Middleware/SecurityHeaders.php)

### Security Middleware Behavior
The middleware adds:

- `X-Content-Type-Options`
- `X-Frame-Options`
- `X-XSS-Protection`
- `Referrer-Policy`
- `Permissions-Policy`
- `Strict-Transport-Security` in production
- `Content-Security-Policy`

The CSP was also adjusted to support Vite local development hosts.

## 9. Improvements Made In This Redesign

### UI Improvements

- replaced fragmented page-specific styling with a shared visual system
- introduced responsive navigation
- replaced generic inline SVG usage with a reusable icon component
- removed the previous overuse of colorful icon blocks
- improved typography hierarchy and spacing
- made auth pages visually consistent with the main app
- improved page responsiveness across the main views
- updated the palette to a Rick and Morty-inspired turquoise, green, yellow, blue, brown, and navy system
- improved status badge contrast and active favorite button visibility

### Code Improvements

- added a proper Rick and Morty API service layer
- reduced repeated controller logic
- improved caching strategy for API-backed data
- replaced per-favorite API calls with batch retrieval
- unified frontend favorite toggling behavior
- moved the app toward shared Vite-managed assets instead of ad hoc page scripts

### Documentation Improvements

- replaced the default Laravel README
- added full project documentation
- documented the tech stack and architecture
- documented the redesign and upgrade decisions

## 10. Known Limitations

- the project still depends on the availability of the external Rick and Morty API
- OTP delivery depends on working mail configuration
- some legacy files remain in the codebase even though the main user-facing routes now use the redesigned pages
- automated tests currently cover only the default Laravel examples and should be expanded

## 11. Recommended Next Improvements

### High Value

- add feature tests for auth, favorites, and OTP flows
- move repeated auth form patterns into smaller Blade components
- add location browsing if that route is meant to become public
- add better empty/loading/error states for all API-backed screens
- add user-facing toast notifications instead of browser alerts

### Security / Reliability

- hash OTP values in storage instead of storing them as plain text
- add scheduled cleanup for expired OTPs
- add stronger API failure handling and graceful fallback messaging
- consider request timeouts and retry strategies for external API calls

### Product / UX

- add location pages and navigation if locations are part of the intended scope
- add filtering by status/species on characters
- add better favorites analytics on the dashboard
- add artwork or illustration assets if you want a more brand-heavy final presentation

## 12. Local Development Setup

### Install Dependencies

```bash
composer install
npm install
```

### Environment Setup

```bash
copy .env.example .env
php artisan key:generate
```

Then configure:

- database credentials
- mail credentials
- app URL

### Database

```bash
php artisan migrate
```

### Run The App

```bash
php artisan serve
npm run dev
```

### Production Assets

```bash
npm run build
```

## 13. Important Files

- [routes/web.php](/C:/xampp/htdocs/RICKANDMORTY/routes/web.php)
- [RickAndMortyApiService.php](/C:/xampp/htdocs/RICKANDMORTY/app/Services/RickAndMortyApiService.php)
- [SecurityHeaders.php](/C:/xampp/htdocs/RICKANDMORTY/app/Http/Middleware/SecurityHeaders.php)
- [app.css](/C:/xampp/htdocs/RICKANDMORTY/resources/css/app.css)
- [app.js](/C:/xampp/htdocs/RICKANDMORTY/resources/js/app.js)
- [app.blade.php](/C:/xampp/htdocs/RICKANDMORTY/resources/views/layouts/app.blade.php)
- [auth.blade.php](/C:/xampp/htdocs/RICKANDMORTY/resources/views/layouts/auth.blade.php)

## 14. Summary

This project is now much closer to a presentable themed application than a starter scaffold. The redesign improved:

- visual consistency
- responsiveness
- icon quality
- documentation quality
- API integration structure
- maintainability of the frontend and controller layer

If you want, the next natural step would be either:

1. adding tests and cleanup for production readiness
2. extending the same design system into any remaining legacy pages and secondary flows
