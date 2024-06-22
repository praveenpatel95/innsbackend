<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    public function success($data = null, $statusCode = 200): JsonResponse
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
    public function fail($data = null, $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
        ], $statusCode);
    }
}
