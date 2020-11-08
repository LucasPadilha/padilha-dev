<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigUser;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'twig-user';
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_user', [TwigRuntimeExtension::class, 'getUser'])
        ];
    }
}
