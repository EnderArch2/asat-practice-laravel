# ASAT Practice - Laravel

A Laravel e-commerce application for managing products and orders. This project demonstrates building a complete order management system with product catalog, shopping cart functionality, and order processing.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- **PHP** 8.1 or higher
- **Composer** (PHP dependency manager)
- **Node.js** 16+ and **npm** (for front-end assets)
- **SQLite** or **MySQL** (database)
- **Git**

## Installation

Follow these steps to set up the project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/EnderArch2/asat-practice-laravel.git
cd asat-practice-laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Create Environment Configuration

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

Edit the `.env` file and configure your database connection. The default is SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

For MySQL, use:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asat_practice
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create Database File (SQLite only)

```bash
touch database/database.sqlite
```

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. Seed the Database (Optional)

Populate the database with sample data:

```bash
php artisan db:seed
```

This will create sample users and products.

### 9. Build Front-end Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### 10. Start the Development Server

In a new terminal, run:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Running Tests

Execute the test suite:

```bash
php artisan test
```

For feature tests only:

```bash
php artisan test tests/Feature
```

For unit tests only:

```bash
php artisan test tests/Unit
```

## Project Structure

- **app/Models/** - Eloquent models (User, Product, Order, OrderItem)
- **app/Http/Controllers/** - Route controllers
- **app/Http/Requests/** - Form request validation
- **app/Observers/** - Model observers (e.g., OrderItemObserver)
- **app/Providers/** - Service providers
- **database/migrations/** - Database schema migrations
- **database/seeders/** - Database seeders for sample data
- **resources/views/** - Blade templates
- **resources/css/** - Tailwind CSS styles
- **resources/js/** - JavaScript files
- **routes/web.php** - Web routes
- **routes/auth.php** - Authentication routes
- **tests/** - Feature and unit tests

## Database Schema

- **Users** - Application users
- **Products** - Product catalog with SKU and pricing
- **Orders** - Customer orders with invoice numbers
- **OrderItems** - Individual items in orders

## Features

- User authentication (login/registration)
- Product management and catalog
- Shopping cart and order creation
- Order tracking with invoice numbers
- Product stock management with SKU
- Admin dashboard for order management

## Troubleshooting

### "SQLSTATE[HY000]: General error"
Ensure the `database/database.sqlite` file exists and the storage directory is writable.

### Assets not loading
Run `npm run build` and clear the view cache with `php artisan view:clear`.

### Port 8000 already in use
Specify a different port: `php artisan serve --port=8001`

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/)

## License

This project is open source and available under the MIT License.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
