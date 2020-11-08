<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigAsset;

use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    /**
     * @var RouteParserInterface
     */
    protected $routeParser;

    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * TwigRuntimeLoader constructor.
     *
     * @param RouteParserInterface $routeParser
     * @param UriInterface         $uri
     */
    public function __construct(RouteParserInterface $routeParser, UriInterface $uri)
    {
        $this->routeParser = $routeParser;
        $this->uri = $uri;
    }

    /**
     * {@inheritdoc}
     */
    public function load(string $class)
    {
        if (TwigRuntimeExtension::class === $class) {
            return new $class($this->routeParser, $this->uri);
        }

        return null;
    }
}
