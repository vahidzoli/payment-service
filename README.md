
# Payment Service

## About
This is a simple payment service developed using Laravel.
## Installation

Install project's dependencies with composer

```bash
  composer install
```

To copy environment variable, use this

```bash
  cp .env.example .env
```

To set the `APP_KEY` value in `.env` file, use this

```bash
  php artisan key:generate
```

To migrate tables to database, run the following command

```bash
  php artisan migrate
```
To create the symbolic link, use the `storage:link` command

```bash
  php artisan storage:link
```

To import CSV file's data into database

```bash
  php artisan import:customers
  php artisan import:products
```

To run the project

```bash
  php artisan serve
```
## Running Tests

To run tests, run the following command

```bash
  php composer test
```

