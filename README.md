# Laravel Role-Based Authentication System

A web application built with Laravel implementing authentication and role-based access control.

## Features

- User registration and login
- Role-based access control (Administrator / Client)
- Middleware-protected admin routes
- Admin dashboard with user statistics:
  - Total users
  - Users registered in the last 30 days
  - Users registered in the last 24 hours
- User management panel displaying all users and their access levels
- MySQL database integration

## Technologies Used

- Laravel
- PHP
- MySQL
- Bootstrap

## Installation

```bash
git clone https://github.com/MunteanuFlorin20/laravel-role-auth-system.git
cd laravel-role-auth-system
composer install
cp .env.example .env
php artisan key:generate
Update your database credentials inside the `.env` file.

```bash
php artisan migrate
php artisan serve
```

If using frontend assets:

```bash
npm install
npm run dev
```
