# Shift Management and Staff Scheduling

## About

This repository is about making the shift management and staff scheduling easier to handle in the daily life. 

## Installation

Clone the repo locally:

```sh
git clone https://github.com/ali-shq/shift_management.git
cd shift_management
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit ShiftManagement in your browser, and login with:

- **Username:** test@example.com
- **Password:** password


## License

This software is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
