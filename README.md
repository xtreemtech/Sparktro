````markdown
# Sparktro Admin — Laravel + Vue 3 + Inertia.js + SQLite Based Starter

This is a starter project integrating a Laravel backend with a Vue 3 frontend using Inertia.js for seamless SPA-like navigation. The frontend uses Vite and pnpm as the package manager.

---

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- pnpm (preferred package manager)
- A database (MySQL/PostgreSQL/SQLite)
- Laravel CLI (optional but recommended)

---

## Installation

### 1. Clone the repository and navigate into it

```bash
git clone https://github.com/mhannan-dev/sparktro-board.git
cd sparktro-board
````

### 2. Install PHP dependencies with Composer

```bash
composer install
```

### 3. Setup environment configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file to configure your database and other settings.

### 4. Run database migrations and seeders

```bash
php artisan migrate --seed
```

### 5. Clear Laravel caches (optional but recommended)

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 6. Install pnpm globally (if not installed)

```bash
npm install -g pnpm
```

### 7. Install frontend dependencies

```bash
pnpm install
```

### 8. Run the development frontend server (with hot reload)

```bash
pnpm run dev
```

### 9. Build frontend assets for production (optional)

```bash
pnpm run build
```

### 10. Serve the Laravel backend

```bash
php artisan serve
```

---

## Usage

Open your browser and visit [http://localhost:8000](http://localhost:8000) to access the application.

---

## Additional Notes

* Make sure your database credentials in `.env` are correctly configured.
* For production deployment, configure your web server accordingly.
* This project uses Vite for asset bundling and pnpm for faster package management.

---
```
