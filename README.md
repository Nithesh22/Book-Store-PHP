

## What it includes

- Public storefront with home page, book listing, search, filters, and detail page
- Admin login and dashboard
- Book CRUD with category assignment, stock management, and pricing
- Relational schema for users, categories, books, sessions, cache, and jobs
- Public API integration using Open Library with graceful fallback when the API is unavailable

## Stack

- Laravel 12
- Blade templates
- SQLite by default for local setup
- MySQL-compatible schema design for the interview requirement

## Local setup

1. Copy the environment file: `cp .env.example .env`
2. Create the SQLite database file: `touch database/database.sqlite`
3. Generate the key: `php artisan key:generate`
4. Run migrations and seeders: `php artisan migrate:fresh --seed`
5. Start the app: `php artisan serve`

If you want MySQL instead of SQLite, update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_store_interview
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate:fresh --seed
```

## Demo admin account

- Email: `admin@leafandledger.test`
- Password: `password`

## Project structure

- `app/Http/Controllers` contains storefront and admin flows
- `app/Http/Requests` contains validation for login and book CRUD
- `app/Models` contains `Book`, `Category`, and `User`
- `app/Services/OpenLibraryService.php` handles the external API integration
- `resources/views` contains all Blade templates

## PDF coverage

- A requirement-by-requirement mapping is included in `PDF_REQUIREMENTS_COVERAGE.md`
- The project covers:
  - Home page
  - Book listing page
  - Book details page
  - Admin login and dashboard
  - Book CRUD
  - Price and availability management
  - Users, books, and categories schema
  - One public API integration displayed in the UI

## Notes

- The PDF explicitly says AI-generated code is not allowed for submission. Treat this project as a practice/reference implementation unless your evaluator has approved assisted work.
- The Open Library section caches API responses and degrades safely to an empty state if the upstream service is unreachable.
