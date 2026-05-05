

## 1. UI/UX Web Design & Development

Required:
- Home page
- Book listing page
- Book details page
- Admin login/dashboard

Covered in:
- Home page: `resources/views/home.blade.php`
- Book listing: `resources/views/books/index.blade.php`
- Book details: `resources/views/books/show.blade.php`
- Admin login: `resources/views/admin/auth/login.blade.php`
- Admin dashboard: `resources/views/admin/dashboard.blade.php`
- Shared layout/styling: `resources/views/layouts/app.blade.php`, `public/css/app.css`

## 2. Laravel Blade & Backend

Required:
- Latest stable Laravel
- Proper MVC architecture
- Admin can add, edit, delete books
- Admin can manage price and availability

Covered in:
- Laravel project scaffold with Laravel 12
- Controllers:
  - `app/Http/Controllers/HomeController.php`
  - `app/Http/Controllers/StorefrontController.php`
  - `app/Http/Controllers/Admin/AuthController.php`
  - `app/Http/Controllers/Admin/DashboardController.php`
  - `app/Http/Controllers/Admin/BookController.php`
- Validation:
  - `app/Http/Requests/Admin/LoginRequest.php`
  - `app/Http/Requests/Admin/StoreBookRequest.php`
  - `app/Http/Requests/Admin/UpdateBookRequest.php`
- Admin middleware:
  - `app/Http/Middleware/EnsureAdmin.php`
- Book CRUD:
  - create/edit/delete routes in `routes/web.php`
  - forms in `resources/views/admin/books/*.blade.php`
- Price and stock fields:
  - `database/migrations/2026_05_05_000004_create_books_table.php`
  - `app/Models/Book.php`

## 3. MySQL Database Design

Required:
- Books
- Users
- Categories optional

Covered in:
- Users table: `database/migrations/0001_01_01_000000_create_users_table.php`
- Categories table: `database/migrations/2026_05_05_000003_create_categories_table.php`
- Books table: `database/migrations/2026_05_05_000004_create_books_table.php`
- Relationships:
  - `app/Models/User.php`
  - `app/Models/Category.php`
  - `app/Models/Book.php`

Note:
- Local default is SQLite for quick setup.
- Schema is fully compatible with MySQL and the README includes MySQL setup instructions.

## 4. API Integration

Required:
- Integrate one public API
- Show integrated API data in the UI

Covered in:
- Open Library integration service: `app/Services/OpenLibraryService.php`
- API data displayed on the home page: `resources/views/home.blade.php`
- Service usage: `app/Http/Controllers/HomeController.php`

## Extra Notes from the PDF

Covered:
- Single Laravel project
- Blade-based frontend
- Clean routing and controllers
- Setup instructions in README
- Searchable public catalog
- Admin dashboard and book management

Submission-related note:
- The PDF says AI-generated code is not allowed for submission.
- This project should be treated as a practice/reference implementation unless assisted work is explicitly permitted.
