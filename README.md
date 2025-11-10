# 🧪 Rick and Morty API (Laravel)

Welcome to the **Rick and Morty API Explorer**, a Laravel-powered project built to explore characters, episodes, and locations from the **Rick and Morty Universe**.  
This app integrates with the public [Rick and Morty API](https://rickandmortyapi.com/api) to display dynamic data using Laravel’s clean MVC architecture.

---

## 🚀 Features

- 🧍 Character Explorer – Browse and search for your favorite characters.
- 🎬 Episode List – View all episodes and the characters featured in them.
- 🌎 Location Viewer– Discover the many worlds across dimensions.
- 🔍 Search & Filter– Filter characters or episodes by name or type.
- ⚡ Fast & Clean UI – Blade templates with responsive TailwindCSS.
- 🔄 API Integration – Data fetched live from the official Rick and Morty API.

---

## 🧩 Tech Stack

| Technology | Purpose |
|-------------|----------|
| **Laravel 11+** | PHP framework for backend logic and routing |
| **Blade Templates** | Frontend templating engine |
| **TailwindCSS** | Modern CSS framework for responsive design |
| **Axios / Fetch** | API request handling |
| **Rick and Morty API** | External data source |

---

## 📦 Installation

Follow these steps to set up the project locally:

```bash
# Clone the repository
git clone https://github.com/<your-username>/rick-and-morty-laravel.git

# Go into the project directory
cd rick-and-morty-laravel

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Install Node dependencies
npm install && npm run dev

# Start local development server
php artisan serve
