<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class ValidationRequestException extends Exception
{
    use ApiResponse;
    public function render(): JsonResponse
    {
        return $this->fail(
            json_decode($this->message),
            $this->getCode()
        );
    }
}
