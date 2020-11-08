<?php
// set a constant that holds the project's folder path, like "/var/www/".
define('ROOT', __DIR__.DIRECTORY_SEPARATOR);

// set a constant that holds the application folder path, like "/var/www/application/".
define('APP', ROOT."application".DIRECTORY_SEPARATOR);

// composer autoload
require ROOT . 'vendor/autoload.php';

$settings = require APP . 'Config/Settings.php';

// set the default timezone
date_default_timezone_set($settings['settings']['defaults']['timezone']);

$App = new \Slim\App($settings);

require APP . 'Config/Dependencies.php';

require APP . 'Config/Controllers.php';

require APP . 'Config/Middlewares.php';

require APP . 'Config/Routes.php';

$App->run();