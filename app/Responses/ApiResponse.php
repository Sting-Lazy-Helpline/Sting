<?php

namespace App\Responses;

use App\Interface\ApiResponseInterface;
use Illuminate\Http\JsonResponse;

class ApiResponse implements ApiResponseInterface
{
    /**
     * Create a standardized JSON response.
     *
     * @param int $code
     * @param string $message
     * @param string $status
     * @param array $data
     * @return JsonResponse
     */
    public function create(int $code, string $message, string $status, array $data = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ], $code);
    }

    /**
     * Create a success response.
     *
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public function success(string $message, array $data = []): JsonResponse
    {
        return self::create(200, $message, 'success', $data);
    }

    /**
     * Create an error response.
     *
     * @param string $message
     * @param int $code
     * @param array $data
     * @return JsonResponse
     */
    public function error(string $message, int $code = 400, array $data = []): JsonResponse
    {
        return self::create($code, $message, 'error', $data);
    }
}