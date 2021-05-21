<?php

namespace EcommerceApp\Services\Checkout;

use EcommerceApp\Repository\Checkout\CheckoutRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckoutService implements CheckoutInterface
{
    public function checkout($id)
    {
        $payload = JWTAuth::payload();

        $checkoutRepo = resolve(CheckoutRepositoryInterface::class);
        $checkoutSuccess = $checkoutRepo->checkout($payload['sub'], $id);

        if($checkoutSuccess)
            return $checkoutSuccess;

        return false;
    }
}