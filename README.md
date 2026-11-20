# HireFlow

HireFlow is a production-oriented Laravel 12 job listing and recruitment platform with candidate, employer, and application workflows.

## Local setup

```text
php artisan migrate:fresh --seed --force
php artisan serve
```

Demo accounts:

- Candidate: `candidate@hireflow.test` / `password`
- Employer: `employer@hireflow.test` / `password`

## cPanel deployment

Upload this entire folder to `/home/kitbinto/hamzaa.top/jobflow`.

Edit `.env` with production values:

```env
APP_NAME=HireFlow
APP_ENV=production
APP_DEBUG=false
APP_URL=https://hamzaa.top/jobflow

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Create the database and import this schema through phpMyAdmin or a migration tool. The root `.htaccess` blocks direct access to Laravel directories and rewrites public traffic into `public/`.

For zero-terminal setup, set a private `SETUP_TOKEN` in `.env`, then visit:
`https://hamzaa.top/jobflow/setup-hireflow/YOUR_TOKEN`
To also load demo accounts and listings, append `?seed=1`.

The frontend is delivered through Tailwind and Alpine.js CDNs, so cPanel deployment does not require Node/npm or a build command.
