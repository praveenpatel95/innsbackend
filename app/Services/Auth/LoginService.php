<?php

namespace App\Services\Auth;

use App\Exceptions\BadRequestException;
use App\Models\User;
use App\Repository\Contracts\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     * @param UserInterface $userRepository
     */
    public function __construct(
        protected UserInterface $userRepository
    ){}

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return User
     * @throws BadRequestException
     */
    public function process(): User
    {
        $user = $this->userRepository->getUserByEmail($this->request->email);
        if (!$user || !Hash::check($this->request->password, $user->password)) {
              throw new BadRequestException(__('auth.failed'),
                Response::HTTP_UNAUTHORIZED);
        }
        return $user->withToken();
    }
}
