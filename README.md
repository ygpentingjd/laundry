# Laundry Management System

A simple laundry management system built with Laravel.

## Features

-   Customer Management
-   Service Management
    -   Laundry Kilat (3-hour service)
    -   Laundry Biasa (24-hour service)
    -   Laundry Berat (48-hour service)
-   Order Management
-   Order Status Tracking
-   Basic Reporting

## Requirements

-   PHP >= 8.1
-   Composer
-   MySQL
-   Laravel 10.x

## Installation

1. Clone the repository

```bash
git clone https://github.com/ygpentingjd/laundry.git
```

2. Install dependencies

```bash
composer install
```

3. Copy .env.example to .env

```bash
cp .env.example .env
```

4. Generate application key

```bash
php artisan key:generate
```

5. Configure your database in .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

7. Start the development server

```bash
php artisan serve
```

## Usage

1. Access the application at http://localhost:8000
2. Add customers through the Customers section
3. Manage services through the Services section
4. Create and track orders through the Orders section

## License

This project is open-sourced software licensed under the MIT license.
