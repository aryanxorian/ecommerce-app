<?php

namespace EcommerceApp\Repository\Cart;

use EcommerceApp\Models\Cart;
use EcommerceApp\Models\Product;
use EcommerceApp\Models\User;

class CartRepository implements CartRepositoryInterface
{
    public function add($cartData)
    {
        $productDetails = Product::find($cartData['product_id']);
        
        $cart = new Cart();
        $cart->user_id = $cartData['user_id'];
        $cart->product_id = $cartData['product_id'];
        $cart->quantity = $cartData['quantity'];
        $cart->save();

        $productDetails = Product::find($cartData['product_id']);
        $cartDetails['product_name'] = $productDetails['name'];
        $cartDetails['product_price'] = $productDetails['price'];
        $cartDetails['quantity'] = $cart['quantity'];
        return $cartDetails;
    }

    public function view($id)
    {
        $user = User::find($id);
        if($user)
        {
            $cart = Cart::where('user_id',$id)->first();
            if($cart)
            {
                $product = Product::find($cart['product_id']);
                $cartDetails['product_name'] = $product['name'];
                $cartDetails['product_price'] = $product['price'];
                $cartDetails['quantity'] = $cart['quantity'];
                return $cartDetails;
            }
        }

        return false;
    }
}