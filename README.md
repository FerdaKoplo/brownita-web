# Brownita Web Documentation

## Table of Contents

1. [Project Overview](#project-overview)
2. [Installation](#installation)
3. [Project Structure](#project-structure)
4. [Configuration](#configuration)
5. [Database Setup](#database-setup)
6. [Running the Application](#running-the-application)
7. [Dependencies](#dependencies)
8. [Features](#features)
9. [Contribution](#contribution)
10. [License](#license)

---

## Project Overview

Brownita Web is an online store web application built using the Laravel framework. The project is designed to manage products, orders, and users for a digital store.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/FerdaKoplo/brownita-web.git
```

2. Navigate into the project directory:

```bash
cd brownita-web
```

3. Install PHP dependencies using Composer:

```bash
composer install
```

4. Install JavaScript dependencies:

```bash
npm install
```

5. Copy the example environment file:

```bash
cp .env.example .env
```

6. Generate the application key:

```bash
php artisan key:generate
```

## Project Structure

```
app/        # Application logic (Controllers, Models, Services)
bootstrap/  # Framework bootstrap files
config/     # Configuration files
database/   # Migrations and seeders
public/     # Public assets (images, JS, CSS)
resources/  # Views and assets
routes/     # Route definitions
storage/    # Logs, cache, and files
tests/      # Unit and feature tests
.env.example # Environment configuration example
composer.json # PHP dependencies
package.json  # JS dependencies
```

## Configuration

* Update `.env` with database credentials and other environment settings.
* Configure mail, cache, and other services in the `.env` file or `config/` directory.

## Database Setup

1. Create a database for the project.
2. Update `.env` with the database name, username, and password.
3. Run migrations to create tables:

```bash
php artisan migrate
```

4. (Optional) Seed the database with sample data:

```bash
php artisan db:seed
```

## Running the Application

Start the development server:

```bash
php artisan serve
```

Access the application at `http://localhost:8000`.

## Dependencies

* PHP >= 8.1
* Laravel >= 10
* Composer
* Node.js and NPM
* MySQL / MariaDB

## Features

* User authentication and authorization
* Product management
* Shopping cart and checkout system
* Order management
* Admin panel for store management

## Contribution

1. Fork the repository.
2. Create a feature branch:

```bash
git checkout -b feature-name
```

3. Commit your changes:

```bash
git commit -m "Add feature"
```

4. Push to the branch:

```bash
git push origin feature-name
```

5. Open a Pull Request.

## License

This project is open-source and free to use.
