# Reference Management System

A Laravel-based web application for managing reference letters, invitations, and user administration. This system allows students to send invitations to professors to submit reference letters, view their completed letters, and manage user roles with an admin dashboard.

---

## Features

### User Functionality
- **Students**:
  - Send invitations to professors.
  - View a list of their completed reference letters.
  - View details of a specific reference letter, including supporting documents.
- **Professors**:
  - Accept invitations without requiring login.
  - Submit reference letters with optional supporting documents.

### Admin Functionality
- View and manage:
  - Users (with the ability to make users administrators).
  - Invitations.
  - Reference letters.
- Delete any record directly from the admin dashboard.

### Other Functionalities
- Responsive design with Bootstrap integration.
- Secured access based on roles:
  - Only users with the `isAdmin` flag can access admin pages.
- File upload and storage for reference letters and supporting documents.

---

## Setup Guide

### Requirements
- PHP 8.0 or higher
- Composer
- Laravel 9.x
- MySQL or any other supported database
- Node.js (for front-end asset management)

XAMPP could be used to fill the PHP, and MySQL requirements, just be aware of having a PHP version that is 8.0 or higher.

---

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/AndyO97/reference-letters-app
   cd reference-management-system

    The repository is currently private. 

2. **Install Dependencies**
    composer install
    npm install
    npm run dev

3. **Set Up the Environment**
Update the following .env variables with your database and storage configuration:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

    APP_URL=http://localhost:8000

4. **Run Database Migrations**
    php artisan migrate

5. **Run the Application**
    php artisan serve

6. **Set Up Storage Link**
    php artisan storage:link


7. ## If Routes are not working as expected
    php artisan route:clear