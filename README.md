## Laravel REST API 

### Introduction

This is a simple REST API built using Laravel. The API includes user registration, authentication, and CRUD operations. It can be integrated with any frontend framework.

## Features

- User Registration
- User Login
- Retrieve User List
- Edit User Details
- Delete User
- Sanctum Authentication

## Installation & Setup
- Clone the repository git clone `https://github.com/toufiqur19/interview_task.git`
- `cd interview_task`
- Install dependencies `composer install`  `npm install && npm run dev`
- Set up the environment
- Create a `.env file` by copying `.env.example` `cp .env.example .env`
- Update the database configuration and other settings in .env.
- Generate application key `php artisan key:generate`
- Run migrations and seeders `php artisan migrate --seed`
- Run the Application `php artisan serve`
- Start the development server php artisan serve Access the application at http://localhost:8000.

## Integration with Frontend
- Laravel Blade Template
- Bootstrap 5
- jQuery
- Ajax
