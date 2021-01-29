# Game Archive

## Table of contents

- [About](#about)
- [Technologies](#technologies)
- [Setup](#setup)
- [Author](#author)
- [License](#license)

## About

An advanced archive web application to manage and organize data, with full CRUD support in database, powerful query builder, creating and saving reports and charts as well as favorite lists for each individual user.

## Technologies

This application is created using:

- PHP 7.3.7
- Laravel 7
- Vuejs 2
- Bootsrap 4
- MySQL 10.3.16
- Sqlite 3
- Highcharts 7

## Setup

This application is written in PHP Laravel and Vuejs.

### Prerequisites

Make sure you have PHP and MySQL/Sqlite up and running on your machine.
Also install latest versions of Laravel and nodejs.

### Installing

To get started, follow these instructions:

1. clone the app
1. Navigate to root path, run the following commands in terminal respectively:
   ```bash
   $ composer install
   $ npm install
   $ npm run dev
   ```
1. Make a copy of `.env.example` file in the root path and rename it to `.env` and open it in a text-editor.
1. If you are using MySQL,

   1. Find the 'MySQL Config Section' and uncomment the section bellow it.
   1. Make sure the other section ('Sqlite Config Section') is commented out.
   1. Each line in this section statrs with a `DB_` . Change the fields based on your database settings. You can pick any name for the `DB_DATABASE` field.
   1. Save the changes to the `.env` file.
   1. Login to your database and create a new database with the same name that you picked for the `DB_DATABASE` field in the `.env` file.

1. If you are using Sqlite,

   1. Find the 'Sqlite Config Section' and uncomment the section bellow it.
   1. Make sure the other section ('MySQL Config Section') is commented out.
   1. Save the changes to the `.env` file.

1. In the root path of application run this command:
   ```bash
   $ php artisan migrate
   $ php artisan key:generate
   $ php artisan storage:link
   ```
1. Start the app using:
   ```bash
   $ php artisan serve
   ```
   Or use a webserver to serve the /public directory of the application.
   Default user is admin@admin.com - adminadmin

## Author

- Alireza Meftahi

## License

This project is licensed under the MIT License.
