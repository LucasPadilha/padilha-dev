<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Illuminate\Database\Capsule\Manager;
use Selective\Config\Configuration;

require __DIR__ . '/vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/var/cache');
}

// Settings
$containerBuilder->addDefinitions(__DIR__.'/config/container.php');

$container = $containerBuilder->build();

$config = $container->get(Configuration::class);

$environment = $config->getString('environment');
$database = $config->getString('database.'.$environment.'.database');
$phinx = $config->getArray('phinx');

$phinx['environments'][$config->getString('phinx.environments.default_database')] = [
	'name' => $database,
	'connection' => $container->get(Manager::class)->connection()->getPdo(),
	'capsule' => $container->get(Manager::class)
];

return $phinx;