<?php
declare(strict_types=1);

namespace App\Application\Middleware\TwigUser;

use App\Domain\User\User;

class TwigRuntimeExtension
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user User model
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the user model
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
