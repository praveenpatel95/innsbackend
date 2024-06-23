<?php

namespace App\Repository\Contracts;

interface UserPreferenceInterface
{
    public function saveOrUpdate(array $preference);
    public function get(int $userId);
}
