<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected RegisterService $registerService,
        protected LoginService $loginService,
    )
    {}

    public function register(RegisterRequest $registerRequest){
        return $this->success(
            $this->registerService->setRequest($registerRequest)->process()
        );
    }

    public function login(LoginRequest $userRequest){
        return $this->success(
            $this->loginService->setRequest($userRequest)->process()
        );
    }
}
