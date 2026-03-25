# Prime Estates

A real estate web platform built with PHP, HTML, CSS, and Bootstrap 5. It connects property agents with buyers — agents can manage listings, and buyers can browse properties and send enquiry requests.

## Features

- Agent registration (with ID and CV upload) and login
- Buyer registration and login
- Agents can create, edit, and delete property listings with up to 4 images
- Dynamic State and LGA dropdowns (all 36 Nigerian states + FCT)
- Public landing page with featured properties
- Property browsing with search and filter
- Property detail page with image gallery and agent contact info
- Property enquiry/request system (buyer → agent)
- Session-based authentication with role separation (agent / buyer)

## Tech Stack

- **Backend:** PHP (custom MVC, no framework)
- **Frontend:** HTML, CSS, Bootstrap 5
- **Database:** MySQL
- **Server:** Apache (via XAMPP or similar)

## Requirements

- PHP 8.0+
- MySQL 5.7+ or MariaDB
- Apache with `mod_rewrite` enabled
- XAMPP / WAMP / Laragon or any local server stack

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/Victoryoola/Prime.git
```

Place the project folder inside your server's web root (e.g. `htdocs/Estate` for XAMPP).

### 2. Set up the database

Import the provided SQL file into MySQL:

```bash
mysql -u root -p < rem.sql
```

Or import it via phpMyAdmin.

This creates the `rem` database with all tables and seeds all 37 Nigerian states and their LGAs.

### 3. Configure the app

Copy the example config and fill in your database credentials:

```bash
cp app/config/config.example.php app/config/config.php
```

Edit `app/config/config.php`:

```php
define('DBHOST', 'your_DB_HOST');
define('DBUSER', 'your_DB_USER');
define('DBPASS', 'your_DB_PASSWORD');
define('DBNAME', 'your_DB_NAME');

define('URLROOT', 'http://localhost');
```

> `URLROOT` should not have a trailing slash.

### 4. Enable Apache mod_rewrite

Make sure `mod_rewrite` is enabled and `AllowOverride All` is set for your web root. The `.htaccess` file at the project root handles URL routing.

### 5. Visit the app

```
http://localhost/Estate/
```

## Project Structure

```
Estate/
├── app/
│   ├── config/         # Database config (not tracked in git)
│   ├── controllers/    # Request handlers
│   ├── helper/         # Auth middleware
│   ├── models/         # Database models
│   ├── routes/         # Route definitions
│   └── views/          # PHP view templates
├── public/
│   ├── css/            # Stylesheets
│   ├── fonts/          # Icon fonts
│   ├── images/         # Property images (uploaded at runtime)
│   └── agents/         # Agent CV and ID uploads
├── .htaccess           # URL rewriting
├── index.php           # Front controller
└── rem.sql             # Database schema + seed data
```

## Default Routes

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/` | Landing page |
| GET | `/login` | Login page |
| POST | `/login` | Process login |
| GET | `/register/agent` | Agent signup |
| GET | `/register/buyer` | Buyer signup |
| GET | `/agent/dashboard` | Agent dashboard (auth) |
| GET | `/agent/properties/create` | Create property (auth) |
| GET | `/properties` | Browse all properties |
| GET | `/properties/{id}` | Property detail |

## Notes

- `app/config/config.php` is excluded from git. Use `config.example.php` as a template.
- Uploaded files (`public/images/`, `public/agents/`) are excluded from git and generated at runtime.
- The app is scoped under `/Estate` by default. To change this, update `$basePath` in `index.php` and `URLROOT` in `config.php`.
