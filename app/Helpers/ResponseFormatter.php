<?php

namespace App\Helpers;

/**
 * Format response.
 */
class ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'status' => false,
        'message' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($message = null, $data = null, $code = 200)
    {
        self::$response['status'] = true;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    /**
     * Give error response.
     */
    public static function error($message = null, $code = 400)
    {
        self::$response['message'] = $message;

        return response()->json(self::$response, $code);
    }

    /**
     * Give server error response. [DEFAULT]
     */
    public static function errorServer($data = null, $code = 400)
    {
        self::$response['message'] = 'Maaf terjadi kesalahan pada server, silakan coba kembali beberapa saat lagi';
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }
}
