<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigAsset;

use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;

class TwigRuntimeExtension
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
     * @param RouteParserInterface $routeParser Route parser
     * @param UriInterface         $uri         Uri
     */
    public function __construct(RouteParserInterface $routeParser, UriInterface $uri)
    {
        $this->routeParser = $routeParser;
        $this->uri = $uri;
    }

    /**
     * Get the full url for an asset
     *
     * @param string $assetName   Asset name
     *
     * @return string
     */
    public function assetUrl(string $assetName): string
    {
        $urlParts = [
            $this->routeParser->fullUrlFor($this->uri, 'public'),
            'assets',
            $assetName
        ];

        return implode('/', $urlParts);
    }
}
