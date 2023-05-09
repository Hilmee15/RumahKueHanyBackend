<?php


namespace App\Common;


class CommonResponse
{

    public static function success($message = 'Sukses', $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }
    public static function fail($message = 'Error', int $statusCode = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null
        ], $statusCode);
    }
}
