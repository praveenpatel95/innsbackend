<?php

namespace App\Services\Auth;

use App\Exceptions\BadRequestException;
use App\Repository\Contracts\UserInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * @param UserInterface $userRepository
     */
    public function __construct(
        protected UserInterface $userRepository
    )
    {
    }

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
     * @return Model|User
     * @throws BadRequestException
     */
    public function process(): Model|User
    {
        try {
            $data = $this->request->all();
            $data['password'] = Hash::make($data['password']);
            $user = $this->userRepository
                ->create($data);
            return $user->withToken();
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
