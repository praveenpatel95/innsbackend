<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\Contracts\UserInterface;

class UserRepository implements UserInterface
{
    /**
     * @param User $user
     */
    public function __construct(
        protected User $user
    ){}

    /**
     * @param array $user
     * @return User
     */
    public function create(array $user): User
    {
        return $this->user->create($user);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): User|null
    {
        return $this->user->where('email', $email)->first();
    }
}
