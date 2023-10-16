<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

/**
 * Format response.
 */
class RestApiFormatter
{
    public static function get($endpoint, $body = [])
    {
        $response = Http::satudata()->get($endpoint, $body);
        return json_decode($response);
    }
}
