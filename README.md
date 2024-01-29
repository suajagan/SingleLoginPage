# SingleLoginPage

## Description
This project is a simple PHP web application with user authentication and a basic API and It uses the Slim framework for routing and PDO for database interactions.

## Table of Contents
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Routes](#routes)

## Installation
1. Clone the repository:
   bash
   git clone https://github.com/suajagan/SingleLoginPage.git

   install the dependencies using composer
    bash
   composer install
## database-setup
1. Create a MySQL database and run the SQL script in sql_scripts/create_table.sql to set up the required tables.
2. Update the database connection details in index.php: or you can update if you create your own database
  $dsn = 'mysql:host=localhost;dbname=SingleLoginUser';
  $user = 'SingleLoginUser';
  $pass = 'password';

## usage
  1. Run the PHP built-in server
     php -S localhost:8000 -t public
  2. Access the application in the browser at ´http://localhost:8000´.

 ## routes

Login: /login (POST)
Logout: /logout (POST)
RememberMe: /rememberMe (POST)
Register: /register (POST)

