<?php
declare(strict_types=1);

namespace App\Interfaces\UserToken;

use App\Domain\UserToken\Exception\UserTokenNotFoundException;
use App\Domain\UserToken\UserToken;
use Illuminate\Database\Eloquent\Collection;

interface UserTokenRepositoryInterface
{
    /**
     * @param bool|null $active
     * @param bool $valid
     * @return Collection
     */
    public function findAll(bool $active = null, bool $valid = true): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @param bool $valid
     * @return UserToken
     * @throws UserTokenNotFoundException
     */
    public function findById(int $id, bool $active = null, bool $valid = true): UserToken;

    /**
     * @param int $user_id
     * @param bool|null $active
     * @param bool $true
     * @return UserToken
     * @throws UserTokenNotFoundException
     */
    public function findByUserId(int $user_id, bool $active = null, bool $valid = true): UserToken;

    /**
     * @param string $token
     * @param bool|null $active
     * @param bool $valid
     * @return UserToken
     * @throws UserTokenNotFoundException
     */
    public function findByToken(string $token, bool $active = null, bool $valid = true): UserToken;
}