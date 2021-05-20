<?php

namespace EcommerceApp\Services\Cart;

use EcommerceApp\Models\Product;
use EcommerceApp\Models\User;
use EcommerceApp\Repository\Cart\CartRepositoryInterface;

class CartService implements CartInterface
{
    public function add($cart)
    {
        if(User::find($cart['user_id']) && Product::find($cart['product_id']))
        {
            $cartRepo = resolve(CartRepositoryInterface::class);
            $cartDetails = $cartRepo->add($cart);
            return $cartDetails;
        }
        return false;
    }

    public function view($id)
    {
        $cartRepo = resolve(CartRepositoryInterface::class);
        $viewDetails = $cartRepo->view($id);
        return $viewDetails;
    }
}