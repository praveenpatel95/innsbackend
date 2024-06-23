<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    public function success($data = null, $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    public function fail($data = null, $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
        ], $statusCode);
    }
}
