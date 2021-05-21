<?php

namespace EcommerceApp\Services\Cart;

use EcommerceApp\Models\Product;
use EcommerceApp\Models\User;
use EcommerceApp\Repository\Cart\CartRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartService implements CartInterface
{
    public function add($cart)
    {
        $payload = JWTAuth::payload();
        $cart['user_id'] = $payload['sub'];
        if(User::find($cart['user_id']) && Product::find($cart['product_id']))
        {
            $cartRepo = resolve(CartRepositoryInterface::class);
            $cartDetails = $cartRepo->add($cart);
            return $cartDetails;
        }
        return false;
    }

    public function view()
    {
        $payload = JWTAuth::payload();
        $cartRepo = resolve(CartRepositoryInterface::class);
        $viewDetails = $cartRepo->view($payload['sub']);
        return $viewDetails;
    }
}