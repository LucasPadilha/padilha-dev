<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigAsset;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;

class TwigMiddleware implements Middleware
{
    /** @var Twig */
    protected $twig;

    /** @var RouteParserInterface */
    protected $routeParser;

    public function __construct(Twig $twig, RouteParserInterface $routeParser)
    {   
        $this->twig = $twig;

        $this->routeParser = $routeParser;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $runtimeLoader = new TwigRuntimeLoader($this->routeParser, $request->getUri());
        $this->twig->addRuntimeLoader($runtimeLoader);

        $extension = new TwigExtension();
        $this->twig->addExtension($extension);

        return $handler->handle($request);
    }
}
