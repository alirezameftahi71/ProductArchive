# Product Archive

## Table of contents
* [About](#about)
* [Technologies](#technologies)
* [Setup](#setup)
* [Author](#author)
* [License](#license)

## About
An advanced archive web application to manage and organize data, with full CRUD support in database, powerful query builder, creating and saving reports and charts as well as favorite lists for each individual user. 

## Technologies
This application is created using:
- PHP 7.3.7
- Laravel 5.8
- JQuery 3.1
- Bootsrap 4
- MySQL 10.3.16
- Highcharts 7

## Setup
This application is written in PHP Laravel and JQuery.

### Prerequisites
Make sure you have PHP and MySQL up and running on your machine.
Also install latest versions of Laravel and nodejs.

### Installing
To get started, follow these instructions: 
1. clone the app
1. Navigate to root path, run the following commands in terminal respectively:
~~~bash
$ composer install
$ npm install
$ npm run dev
~~~
1. Make a copy of `.env.example` file in the root path and rename it to `.env` and open it in a text-editor.
1. Find the lines starting with `DB_` . Change the fields based on your database settings. You can pick any name for the `DB_DATABASE` field. 
1. Login to your database and create a new database with the same name that you picked for the `DB_DATABASE` field in the `.env` file. 
1. In the root path of application run this command:
~~~bash
$ php artisan migrate
$ php artisan key:generate
$ php artisan storage:link
~~~
1. Start the app using:
~~~bash
$ php artisan serve
~~~

## Author 
- Alireza Meftahi

## License
This project is licensed under the MIT License.
