<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigUser;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\Twig;

class TwigMiddleware implements Middleware
{
    /** @var Twig */
    protected $twig;

    public function __construct(Twig $twig)
    {   
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $runtimeLoader = new TwigRuntimeLoader($request->getAttribute('user'));
        $this->twig->addRuntimeLoader($runtimeLoader);

        $extension = new TwigExtension();
        $this->twig->addExtension($extension);

        return $handler->handle($request);
    }
}
