<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param  string  $message
     * @param  mixed  $data
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  mixed  $errors
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ], $status);
    }
}