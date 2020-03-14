# Bloggie

A blog application built with [Zend Framework 3](https://github.com/zendframework/zendframework)

## Getting Started

### Prerequisites

* [PHP^7.0](https://www.php.net/downloads)
* [MySQL](https://www.mysql.com/downloads/)
* [Composer](https://getcomposer.org/)

#### Note
Both MySQL and Apache server could be used if [XAMPP](https://www.apachefriends.org/download.html) is downloaded and installed.
You could also use PHP web server for testing instead of Apache.

### Deploying

#### Dependencies
In the project directory, install all dependencies with:

```bash
$ cd path/to/install
$ composer install
```

#### Database
Run `bloggie_zend.sql`, which is located in `data` directory.
If you are using XAMPP, open [phpMyAdmin](http://localhost/phpmyadmin/index.php), import the sql file and start MySQL module in XAMPP Control Panel.

#### Web server

* Option 1: PHP web server

```bash
$ php -S 0.0.0.0:8080 -t public
# OR use the composer alias:
$ composer run --timeout 0 serve
```

The application could be opened on port 8080 (http://localhost:8080).

* Option 2: Apache web server (XAMPP)

Open XAMPP Control Panel.
In Apache module, choose Config option to open `httpd.conf`.
Change the DocumentRoot and Directory to the location of your project.
After saving the change, start Apache module in XAMPP Control Panel.
The application could be opened on localhost (http://localhost/).

#### Admin account
Currently, there are 2 admin accounts which could be used for testing purpose.
* vu@gmail.com
* test@gmail.com
Both accounts had the same password: **testing**.

## Build with
* PHP 7
* Zend Framework 3
* Doctrine 2

## Feature

* User: read blog posts and leave comments
* Admin:
  Authentication
  Change admin account data
  CRUD function for post. Post could be published or saved as draft (which normal user won't be able to read).

## Live demo

Working in development

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
