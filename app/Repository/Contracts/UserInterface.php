<?php

namespace App\Repository\Contracts;
use App\Models\User;
interface UserInterface
{
    public function create(array $user): User;
    public function getUserByEmail(string $email): User|null;
}
