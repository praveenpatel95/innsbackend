<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PreferenceRequest;
use App\Services\User\GetUserPreferenceService;
use App\Services\User\SaveUserPreferenceService;
use Illuminate\Http\JsonResponse;

class UserPreferenceController extends Controller
{
    /**
     * @param SaveUserPreferenceService $saveUserPreferenceService
     * @param GetUserPreferenceService $getUserPreferenceService
     */
    public function __construct(
        protected SaveUserPreferenceService $saveUserPreferenceService,
        protected GetUserPreferenceService $getUserPreferenceService,
    )
    {}

    /**
     * @param PreferenceRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function storeOrUpdate(PreferenceRequest $request): JsonResponse
    {
        return $this->success($this->saveUserPreferenceService
            ->setRequest($request)
            ->process()
        );
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return $this->success($this->getUserPreferenceService->process());
    }
}
