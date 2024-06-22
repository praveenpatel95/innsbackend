<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadRequestException extends Exception
{
    use ApiResponse;
    function render()  : JsonResponse
    {
        return $this->fail($this->message,
           $this->getCode()
        );
    }
}
