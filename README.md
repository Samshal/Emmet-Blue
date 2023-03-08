# Emmet-Blue [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/EmmetBlue/Emmet-Blue/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/EmmetBlue/Emmet-Blue/?branch=master) [![Build Status](https://travis-ci.org/EmmetBlue/Emmet-Blue.svg?branch=master)](https://travis-ci.org/EmmetBlue/Emmet-Blue)

Emmetblue is a PHP micro-framework that provides the most basic components for bootstrapping any application. It includes libraries for agnostic database communication, session management, data validation, logging, and more.

## Installation
To install Emmetblue, you can clone the repository from GitHub:

```bash
git clone https://github.com/Samshal/Emmet-Blue.git
```
Or, you can use Composer to install the dependencies:

```
composer install
```

## Usage
Emmetblue is designed to be easy to use and flexible enough to fit a wide range of applications. Here's an example of how to create a simple REST API using Emmetblue and the Slim framework:

```php
<?php

require_once 'vendor/autoload.php';

$app = new \Slim\App();

// Define your routes here

$app->run();
```

From here, you can define your routes and handlers as needed for your application.

## Components
Emmetblue includes several libraries and components for working with PHP applications:

- Database: Emmetblue includes an agnostic database library that can be used to connect to a variety of databases, including MySQL, PostgreSQL, and SQLite.
- Session: Emmetblue includes a library for managing session data in PHP applications.
- Validation: Emmetblue includes a library for validating user input in PHP applications.
- Logging: Emmetblue includes a simple logging library for PHP applications.

## Contributing
If you would like to contribute to Emmetblue, please feel free to submit a pull request or open an issue. We welcome contributions from the community!
