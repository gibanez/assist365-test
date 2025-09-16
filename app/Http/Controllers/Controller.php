<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function success($data = null, $metada = null, $status = 200): JsonResponse
    {
        return response()->json([
            'jsonapi' => [
                'version' => '1.0'
            ],
            'data' => $data,
            'meta' => $metada,
        ], $status);
    }

    protected function error($errors, $status = 400): JsonResponse
    {
        return response()->json([
            'jsonapi' => [
                'version' => '1.0'
            ],
            'errors' => is_array($errors) ? $errors : [['detail' => $errors]],
        ], $status);
    }
}
