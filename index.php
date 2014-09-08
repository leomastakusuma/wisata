<?php

/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load application config (error reporting etc.)
require 'application/config/config.php';

// load application class
require 'application/libs/application.php';
require 'application/libs/controller.php';
require 'application/libs/models.php';
require 'application/libs/function.php';
require 'application/libs/session.php';
//require 'application/libs/function_query.php';

//load plugins Auth
require 'plugins/Auth.php';

// start the application
$app = new Application();
