<?php
declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Utils\TwigAssetUrl;
use App\Utils\TwigTranslation;
use Illuminate\Database\Capsule\Manager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Odan\Twig\TwigAssetsExtension;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Psr7\Factory\UriFactory;
use Slim\Psr7\Uri;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

return [
    Configuration::class => function() {
        return new Configuration(require __DIR__.'/settings.php');
    },

    App::class => function(ContainerInterface $c) {
        AppFactory::setContainer($c);

        // Call Manager so it becomes available globally
        $c->get(Manager::class);

        return AppFactory::create();
    },

    LoggerInterface::class => function(ContainerInterface $c) {
        $config = $c->get(Configuration::class);

        $logger = new Logger($config->getString('logger.name'));

        $logger->pushProcessor(new UidProcessor());
        
        $logger->pushHandler(new StreamHandler($config->getString('logger.path'), $config->getString('logger.level')));

        return $logger;
    },

    ServerRequestCreatorFactory::class => function(ContainerInterface $c) {
        $serverRequestCreator = ServerRequestCreatorFactory::create();

        return $serverRequestCreator->createServerRequestFromGlobals();
    },

    ResponseFactoryInterface::class => function(ContainerInterface $c) {
        return $c->get(App::class)->getResponseFactory();
    },

    HttpErrorHandler::class => function(ContainerInterface $c) {
        return new HttpErrorHandler($c->get(App::class)->getCallableResolver(), $c->get(App::class)->getResponseFactory());
    },

    ShutdownHandler::class => function(ContainerInterface $c) {
        return new ShutdownHandler(
            $c->get(ServerRequestCreatorFactory::class), 
            $c->get(HttpErrorHandler::class), 
            $c->get(Configuration::class)->getBool('error.display_error_details')
        );
    },
    
    Manager::class => function(ContainerInterface $c) {
        $environment = $c->get(Configuration::class)->getString('environment');

        $settings = $c->get(Configuration::class)->getArray('database.'.$environment);

        $capsule = new Manager();
        $capsule->addConnection($settings);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    },

    TwigMiddleware::class => function(ContainerInterface $c) {
        return TwigMiddleware::createFromContainer($c->get(App::class), Twig::class);
    },

    Twig::class => function(ContainerInterface $c) {
        $app = $c->get(App::class);
        $settings = $c->get(Configuration::class);

        $options = $settings->getArray('twig.options');

        if ($options['cache'] === true) {
            $options['cache'] = $settings->getString('twig.cache_path');
        }

        $twig = Twig::create($settings->getArray('twig.paths'), $options);

        $loader = $twig->getLoader();
        if ($loader instanceof FilesystemLoader) {
            $loader->addPath($settings->getString('public'), 'public');
        }

        $twig->addExtension(new DebugExtension());
        $twig->addExtension(new TwigAssetsExtension($twig->getEnvironment(), $settings->getArray('assets')));
        $twig->addExtension(new TwigTranslation($c->get(Translator::class)));
        // $twig->addExtension(new TwigAssetUrl($c->get(RouteParserInterface::class)));

        /** @var FlashBagInterface $flashbag */
        $flashbag = $c->get(Session::class)->getFlashBag();
        $environment = $twig->getEnvironment();
        $environment->addGlobal('flashbag', $flashbag);
        $environment->addFunction(new TwigFunction(
            'flash', 
            function(string $key, $default = null) use ($flashbag) {
                return $flashbag->get($key, $default ?? [])[0] ?? null;
            }
        ));

        return $twig;
    },

    Translator::class => function(ContainerInterface $c) {
        $settings = $c->get(Configuration::class);

        $translator = new Translator($settings->getString('translation.default_locale'));

        $translator->addLoader('array', new ArrayLoader());

        foreach ($settings->getArray('translation.resources') as $name => $file) {
            $translator->addResource('array', require_once $settings->getString('translation.translation_path').'/'.$file, $name);
        }

        return $translator;
    },

    Session::class => function (ContainerInterface $c) {
        $settings = $c->get(Configuration::class)->getArray('session');

        return new Session(new NativeSessionStorage($settings));
    },

    SessionInterface::class => function (ContainerInterface $c) {
        return $c->get(Session::class);
    },

    FlashBagInterface::class => function(ContainerInterface $c) {
        return $c->get(Session::class)->getFlashBag();
    },

    RouteParserInterface::class => function(ContainerInterface $c) {
        return $c->get(App::class)->getRouteCollector()->getRouteParser();
    },

    ErrorMiddleware::class => function (ContainerInterface $c) {
        $settings = $c->get(Configuration::class);
        $app = $c->get(App::class);

        $errorMiddleware = new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            $settings->getBool('error.display_error_details'),
            $settings->getBool('error.log_errors'),
            $settings->getBool('error.log_error_details')
        );

        $errorMiddleware->setDefaultErrorHandler($c->get(HttpErrorHandler::class));

        return $errorMiddleware;
    },
];