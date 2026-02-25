# Task Assignment Application

Laravel 11 application with REST APIs, service layer, scheduled jobs, queues, and Admin/User UI (Blade + Livewire). No Node.js or npm required.

---

## Prerequisites

- **PHP 8.2+** with extensions: `bcmath`, `ctype`, `curl`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`
- **Composer** ([getcomposer.org](https://getcomposer.org))
- **SQLite** (default, no setup) or **MySQL** / **MariaDB**
- Optional: **Redis** (for queue/cache/session in production)

---

## How to Run This Project (End to End)

### 1. Get the code

```bash
# If using Git
git clone <repository-url> task-assignment
cd task-assignment
```

Or extract the project ZIP and open a terminal in the project root.

---

### 2. Install PHP dependencies

```bash
composer install
```

Use `composer install --no-dev` for production.

---

### 3. Environment file

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` if needed:

| Setting | Default | Notes |
|--------|---------|--------|
| `APP_NAME` | Laravel | Your app name |
| `APP_URL` | http://localhost | Base URL (e.g. `http://localhost:8000`) |
| `DB_CONNECTION` | sqlite | Use `mysql` for MySQL |
| `QUEUE_CONNECTION` | database | Use `redis` if Redis is installed |
| `SESSION_DRIVER` | database | Use `redis` with Redis |
| `CACHE_STORE` | database | Use `redis` with Redis |

**Using MySQL instead of SQLite:** set in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

### 4. Database migration and seed

```bash
php artisan migrate --seed
```

This runs all migrations and seeds the default admin user.

---

### 5. Run the application

```bash
php artisan serve
```

Open **http://localhost:8000** in your browser.

- **Login (user):** register a new account or use any seeded user.
- **Login (admin):** `admin@example.com` / `ChangeMe123!` (change in production.)

---

### 6. Optional: Queue worker (for jobs)

If the app uses queues (notifications, reports, emails), run a worker in a **separate terminal**:

```bash
# Using database driver (default in .env)
php artisan queue:work database -v

# Or with Redis
php artisan queue:work redis -v
```

Keep this running while testing features that dispatch jobs.

---

### 7. Optional: Scheduler (cron)

For daily cleanup, report generation, health checks, etc., add a cron entry:

```bash
* * * * * cd /path/to/task-assignment && php artisan schedule:run >> /dev/null 2>&1
```

Replace `/path/to/task-assignment` with your project path. On Windows, use Task Scheduler to run `php artisan schedule:run` every minute.

---

## Summary Checklist

| Step | Command |
|------|---------|
| 1. Dependencies | `composer install` |
| 2. Environment | `cp .env.example .env` then `php artisan key:generate` |
| 3. SQLite file (if using SQLite) | `touch database/database.sqlite` |
| 4. Database | `php artisan migrate --seed` |
| 5. Run app | `php artisan serve` |
| 6. (Optional) Queue | `php artisan queue:work database -v` |
| 7. (Optional) Cron | `* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1` |

---

## Default credentials

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@example.com | ChangeMe123! |

Change the admin password after first login (Profile or user management).

---

## Tech stack

- **Backend:** Laravel 11, Sanctum (API auth)
- **UI:** Blade, Livewire, Tailwind (CDN) — no Node/npm
- **Database:** SQLite (default) or MySQL
- **Queue/Cache/Session:** Database driver by default; Redis optional
- **API:** REST; Postman collection in `postman/` (see `postman/README.md`)

---

## Project structure (high level)

- **`app/Services/`** — Business logic (User, Notification, Report, etc.)
- **`app/Jobs/`** — Queued jobs (email, report, notification)
- **`routes/web.php`** — Web routes (Blade/Livewire)
- **`routes/api.php`** — API routes (Sanctum)
- **`resources/views/livewire/`** — Livewire views (auth, user, admin)
- **`config/admin.php`** — Admin IP whitelist (`ADMIN_IP_WHITELIST` in `.env`)

---

## Troubleshooting

- **500 or “key not set”:** Run `php artisan key:generate`.
- **Migration errors:** Check `DB_*` in `.env` and that the database exists (MySQL) or `database/database.sqlite` exists (SQLite).
- **Class Redis not found:** Use `QUEUE_CONNECTION=database` and `CACHE_STORE=database` in `.env`, or install Redis and use `REDIS_CLIENT=predis` with the `predis/predis` package.
- **Admin routes blocked:** Ensure your IP is in `ADMIN_IP_WHITELIST` in `.env` (default: `127.0.0.1,::1`).

---
