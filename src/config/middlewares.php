<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use DI\Container;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;
use App\Application\Middleware\TwigAsset\TwigMiddleware as TwigAssetMiddleware;
use App\Application\Middleware\TwigUser\TwigMiddleware as TwigUserMiddleware;

/** TODO: Verificar possibilidade de criar middleware que recebe parâmetro para identificar grupos de URL */
return function (Container $c) {
    $app = $c->get(App::class);

    $app->addBodyParsingMiddleware();

    $app->add(SessionMiddleware::class);
    $app->addRoutingMiddleware();
    $app->add(TwigMiddleware::class);
    $app->add(TwigAssetMiddleware::class);
    $app->add(ErrorMiddleware::class);
};
