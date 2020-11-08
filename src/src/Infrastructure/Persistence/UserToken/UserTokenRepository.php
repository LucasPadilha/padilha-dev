<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\UserToken;

use App\Domain\UserToken\Exception\UserTokenNotFoundException;
use App\Domain\UserToken\UserToken;
use App\Interfaces\UserToken\UserTokenRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    /** @var UserToken */
    private $db;

    public function __construct(UserToken $db)
    {
        $this->db = $db;
    }

    public function findAll(?bool $active = null, bool $valid = true): Collection
    {
        if (!is_null($active)) {
            if ($valid) {
                $this->db::active($active)->valid()->get();
            }

            return $this->db::active($active)->get();
        }

        if ($valid) {
            return $this->db->valid()->get();
        }

        return $this->db::get();
    }

    public function findById(int $id, ?bool $active = null, bool $valid = true): UserToken
    {
        $userToken = $this->db::where('id', $id);

        if (!is_null($active)) {
            $userToken->active($active);
        }

        if ($valid) {
            $userToken->valid();
        }

        if (!$userToken->exists()) {
            throw new UserTokenNotFoundException();
        }

        return $userToken->first();
    }

    public function findByUserId(int $user_id, ?bool $active = null, bool $valid = true): UserToken
    {
        $userToken = $this->db::where('user_id', $user_id);

        if (!is_null($active)) {
            $userToken->active($active);
        }

        if ($active) {
            $userToken->valid();
        }

        if (!$userToken->exists()) {
            throw new UserTokenNotFoundException();
        }

        return $userToken->first();
    }

    public function findByToken(string $token, ?bool $active = null, bool $valid = true): UserToken
    {
        $userToken = $this->db::where('token', $token);

        if (!is_null($active)) {
            $userToken = $userToken->active($active);
        }

        if ($valid) {
            $userToken = $userToken->valid();
        }

        if (!$userToken->exists()) {
            throw new UserTokenNotFoundException();
        }

        return $userToken->first();
    }
}   