<?php
declare(strict_types=1);

use Monolog\Logger;

date_default_timezone_set('America/Sao_Paulo');

$settings = [];

$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'].'/tmp';
$settings['public'] = $settings['root'].'/public';

$settings['error'] = [
    'display_error_details' => true,
    'log_errors' => false,
    'log_error_details' => false
];

$settings['environment'] = 'dev';

$settings['logger'] = [
    'name' => 'lplabs-app',
    'path' => isset($_ENV['docker']) ? 'php://stdout' : $settings['root'].'/logs/app.log',
    'level' => Logger::DEBUG
];  

$settings['database'] = [];

$settings['database']['dev'] = [
    'driver' => 'pgsql',
    'host' => 'lplabs_db',
    'username' => 'lplabs',
    'password' => 'lplabs',
    'database' => 'lplabs',
    'charset' => 'utf8',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => ''
];

$settings['database']['prod'] = [
    'driver' => 'pgsql',
    'host' => 'lplabs_db',
    'username' => 'lplabs',
    'password' => 'lplabs',
    'database' => 'lplabs',
    'charset' => 'utf8',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => ''
];

$settings['phinx'] = [
    'paths' => [
        'migrations' => $settings['root'].'/database/migrations/',
        'seeds' => $settings['root'].'/database/seeds/'
    ],
    'migration_base_class' => 'App\Infrastructure\Migration',
    'seed_base_class' => 'App\Infrastructure\Seed',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'lplabs',
        'lplabs' => []
    ]
];

$settings['twig'] = [
    'paths' => [
        $settings['root'].'/src/View',
        $settings['public']
    ],
    'cache_path' => $settings['temp'].'/cache',
    'options' => [
        'cache' => false,
        'debug' => true
    ]
];

$settings['assets'] = [
    'path' => $settings['public'].'/cache',
    'url_base_path' => '/public/cache/',
    'cache_enabled' => true,
    'cache_path' => $settings['temp'],
    'cache_name' => 'assets-cache',
    'minify' => 0
];

$settings['translation'] = [
    'default_locale' => 'pt_BR',
    'translation_path' => $settings['root'].'/src/Translation',
    'resources' => [
        'pt_BR' => 'pt_BR.php',
        'en_US' => 'en_US.php'
    ]
];

$settings['session'] = [
    'name' => 'lplabs',
    'cache_expire' => 0,
];

return $settings;
