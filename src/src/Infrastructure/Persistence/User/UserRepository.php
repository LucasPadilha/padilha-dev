<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\Exception\EmailInUseException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /** @var User */
    private $db;
    
    public function __construct(User $db)
    {
        $this->db = $db;
    }

    public function findAll(?bool $active = null): Collection
    {
        if (!is_null($active)) {
            return $this->db::active($active)->get();
        }

        return $this->db::get();
    }

    public function findById(int $id, ?bool $active = null): User
    {
        $user = $this->db::where('id', $id);

        if (!is_null($active)) {
            $user = $user->active($active);
        }

        if (!$user->exists()) {
            throw new UserNotFoundException();
        }

        return $user->first();
    }

    public function findByEmail(string $email, $active = null): User
    {
        $user = $this->db::where('email', $email);

        if (!is_null($active)) {
            $user = $user->active($active);
        }

        if (!$user->exists()) {
            throw new UserNotFoundException();
        }

        return $user->first();
    }

    public function isEmailInUse(string $email): UserRepositoryInterface
    {
        $user = $this->db::where('email', $email);

        if ($user->exists()) {
            throw new EmailInUseException();
        }

        return $this;
    }
}