<?php

namespace EcommerceApp\Repository\Checkout;

use EcommerceApp\Models\Address;
use EcommerceApp\Models\Cart;
use EcommerceApp\Models\Order;
use EcommerceApp\Models\Product;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function checkout($user_id, $address_id)
    {
        $cart = Cart::firstWhere('user_id', $user_id);
        if($cart && Address::where('user_id', $user_id)
                ->where('id',$address_id)->exists())
        {
            // $cart = Cart::firstWhere('user_id', $user_id);
            $product = Product::find($cart['product_id']);

            $this->order->user_id = $user_id;
            $this->order->address_id = $address_id;
            $this->order->total = $cart['quantity'] * $product['price'];
            $this->order->save();

            Cart::where('user_id', $user_id)->delete();

            return $this->order;
        }

        return false;
    }
}