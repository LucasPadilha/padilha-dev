<?php
declare(strict_types=1);

namespace App\Utils;

use Slim\Interfaces\RouteParserInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigAssetUrl extends AbstractExtension
{
    /** @var RouteParserInterface */
    private $routeParser;

    public function __construct(RouteParserInterface $routeParser)
    {
        $this->routeParser = $routeParser;
    }

    public function getName()
    {
        return 'twig_asset_url';
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('asset_url', array($this, 'assetUrl'))
        ];
    }

    public function assetUrl(string $asset)
    {
        return $this->routeParser->urlFor('public') . '/assets/' . $asset;
    }
}