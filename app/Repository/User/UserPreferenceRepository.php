<?php

namespace App\Repository\User;

use App\Models\UserPreference;
use App\Repository\Contracts\UserPreferenceInterface;

class UserPreferenceRepository implements UserPreferenceInterface
{
    /**
     * @param UserPreference $userPreference
     */
    public function __construct(
        protected UserPreference $userPreference
    )
    {}

    /**
     * @param array $preference
     * @return UserPreference
     */
    public function saveOrUpdate(array $preference) :UserPreference
    {
        return $this->userPreference->updateOrCreate($preference);
    }

    /**
     * @param int $userId
     * @return UserPreference
     */
    public function get(int $userId): UserPreference
    {
        return $this->userPreference->where('user_id', $userId)->first();
    }
}
