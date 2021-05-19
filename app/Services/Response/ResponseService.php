<?php

namespace EcommerceApp\Services\Response;

use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    private static $responseCode = [
        'successResponse' => 200,
        'errorResponse' => 400,
        'internalServerError' => 500
    ];

    private static function response($responseCode, $data=null, $message = null)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ],$responseCode);
    }

    /**
     * @param 
     */
    public static function __callStatic($name, $arguments)
    {
        return Self::response(Self::$responseCode[$name], $arguments[0], $arguments[1]);
    }
}