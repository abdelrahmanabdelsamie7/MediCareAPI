<?php

namespace App\Traits;

trait ResponseJsonTrait
{
    public function sendSuccess(string $msg, mixed $data = [], int $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $msg,
            'data' => $data
        ], $status);
    }
}
