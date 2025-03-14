<?php

namespace App\Helpers;

trait ApiResponse
{
    public function authSuccess($data, $token = null, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'token' => $token,
            'message' => $message,
            'code' => $code
        ], $code);
    }

    public function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], $code);
    }

    public function error($data, $message = null, $code = 500)
    {
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], $code);
    }
}
