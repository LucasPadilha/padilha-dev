<?php
declare(strict_types=1);

use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use DI\ContainerBuilder;
use Slim\App;
use Slim\Factory\ServerRequestCreatorFactory;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Settings
$containerBuilder->addDefinitions(__DIR__.'/container.php');

// Repositories
$containerBuilder->addDefinitions(__DIR__.'/repositories.php');

// Build PHP-DI container
$container = $containerBuilder->build();

// Create APP
$app = $container->get(App::class);

// Register middlewares
$middleware = require __DIR__ . '/middlewares.php';
$middleware($container);

// Register routes
$routes = require __DIR__ . '/routes.php';
$routes($app);

register_shutdown_function($container->get(ShutdownHandler::class));

// Run App & Emit Response
// return $app;

$response = $app->handle($container->get(ServerRequestCreatorFactory::class));
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);