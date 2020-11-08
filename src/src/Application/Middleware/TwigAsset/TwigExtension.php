<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigAsset;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'twig-asset';
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_url', [TwigRuntimeExtension::class, 'assetUrl'])
        ];
    }
}
