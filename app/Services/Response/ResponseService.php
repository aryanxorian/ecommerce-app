<?php

namespace EcommerceApp\Services\Response;

use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    private static $responseCode = [
        // 'successResponse' => 200,
        // 'errorResponse' => 400,
        // 'internalServerError' => 500
        'registerSuccessfullResponse' => ['code' => 200, 'message' => 'Account registration Succrssfull', 'status' => true],
        'loginSuccessfullResponse' => ['code' => 200, 'message' => 'Successfully Logged In', 'status' => true],
        'invalidCredentialsResponse' => ['code' => 401, 'message' => 'Invalid Credentials', 'status' => false],
        'internalServerErrorResponse' => ['code' => 500, 'message' => 'Operation Invalid', 'status' => false],
        'logoutSuccessfullResponse' => ['code' => 200, 'message' => 'Logged out Successfully', 'status' => true],
        'profileSuccessfullResponse' => ['code' => 200, 'message' => 'User Profile', 'status' => true],
        'productAddedSuccessfullResponse' => ['code' => 200, 'message' => 'Product added Succsessfully', 'status' => true],
        'productDeletedSuccessfullResponse' => ['code' => 200, 'message' => 'Product Deleted Successfully', 'status' => true],
        'itemAddedSuccessfullResponse' => ['code' => 200, 'message' => 'Item Added to Cart Successfully', 'status' => true],
        'cartDetailsSuccessfullResponse' => ['code' => 200, 'message' => 'Cart Details', 'status' => true],
        'searchErrorResponse' => ['code' => 200, 'message' => 'No products found', 'status' => false],
        'listProductSuccessfullResponse' => ['code' => 200, 'message' => 'List of Products', 'status' => true],
        'addessAddedSuccessfullResponse' => ['code' => 200, 'message' => 'Address has been successfully added', 'status' => true],
        'viewAddressSuccessfullResponse' => ['code' => 200, 'message' => 'User Addresses', 'status' => true],
        'addressDeletedResponse' => ['code' => 200, 'message' => 'Address Deleted Successfully', 'status' => true],
        'checkoutCompleteResponse' => ['code' => 200, 'message' => 'Checkout Successfull', 'status' => true]
    ];

    private static function response($response, $data=null)
    {
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message'],
            'data' => $data
        ],$response['code']);
    }

    /**
     * @param 
     */
    public static function __callStatic($name, $arguments)
    {
        return Self::response(Self::$responseCode[$name], $arguments[0]);
    }
}