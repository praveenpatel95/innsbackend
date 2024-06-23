<?php

namespace App\Services\User;

use App\Models\UserPreference;
use App\Repository\Contracts\UserPreferenceInterface;
use Illuminate\Support\Facades\Auth;

class GetUserPreferenceService
{
    /**
     * @param UserPreferenceInterface $userPreferenceRepository
     */
    public function __construct(
        protected UserPreferenceInterface $userPreferenceRepository
    )
    {}

    /**
     * @return UserPreference
     */
    public function process() :UserPreference
    {
        $userId = Auth::id();
        return $this->userPreferenceRepository->get($userId);

    }
}
