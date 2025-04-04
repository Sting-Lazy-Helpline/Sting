<?php

namespace App\Interface;

use Illuminate\Http\JsonResponse;

interface ApiResponseInterface
{
    public function create(int $code, string $message, string $status, array $data = []): JsonResponse;

    public function success(string $message, array $data = []): JsonResponse;

    public function error(string $message, int $code = 400, array $data = []): JsonResponse;
}