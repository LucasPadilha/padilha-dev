<?php
declare(strict_types=1);

namespace App\Interfaces\User;

use App\Domain\User\Exception\EmailInUseException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return User
     * @throws UserNotFoundException
     */
    public function findById(int $id, bool $active = null): User;

    /**
     * @param string $email
     * @param bool|null $active
     * @return User
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email, $active = null): User;

    /**
     * @param string $email
     * @return UserRepositoryInterface
     * @throws EmailInUseException
     */
    public function isEmailInUse(string $email): UserRepositoryInterface;
}