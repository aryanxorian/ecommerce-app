<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Services\Checkout\CheckoutInterface;
use EcommerceApp\Services\Response\ResponseService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout($id, CheckoutInterface $order)
    {
        $checkoutComplete = $order->checkout($id);

        if($checkoutComplete)
            return ResponseService::checkoutCompleteResponse($checkoutComplete);

        return ResponseService::internalServerErrorResponse(null);
    }
}
