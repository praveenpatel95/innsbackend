<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    /**
     * @param RegisterService $registerService
     * @param LoginService $loginService
     */
    public function __construct(
        protected RegisterService $registerService,
        protected LoginService $loginService,
    )
    {}

    /**
     * @param RegisterRequest $registerRequest
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        return $this->success(
            $this->registerService->setRequest($registerRequest)->process(),
            Response::HTTP_CREATED
        );
    }

    /**
     * @param LoginRequest $userRequest
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function login(LoginRequest $userRequest): JsonResponse
    {
        return $this->success(
            $this->loginService->setRequest($userRequest)->process()
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success();
    }
}
