<?php

namespace App\Services\User;

use App\Exceptions\BadRequestException;
use App\Repository\Contracts\UserPreferenceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SaveUserPreferenceService
{
    public function __construct(
        protected UserPreferenceInterface $userPreferenceRepository
    )
    {}

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function process()
    {
        try {
            $data = $this->request->all();
            $data['user_id'] = Auth::id();
            return $this->userPreferenceRepository->saveOrUpdate($data);
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
