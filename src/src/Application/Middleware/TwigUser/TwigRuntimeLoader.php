<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigUser;

use App\Domain\User\User;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    /**
     * TwigRuntimeLoader constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function load(string $class)
    {
        if (TwigRuntimeExtension::class === $class) {
            return new $class($this->user);
        }

        return null;
    }
}
