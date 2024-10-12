<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait APIResponse
{
    private function response($data = null, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function success($data, $message = null, $code = 200): JsonResponse
    {
        return $this->response($data, $message, $code);
    }

    public function error($message, $code = 400): JsonResponse
    {
        return $this->response(null, $message, $code);
    }
}
