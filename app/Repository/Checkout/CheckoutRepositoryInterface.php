<?php

namespace EcommerceApp\Repository\Checkout;

interface CheckoutRepositoryInterface
{
    public function checkout($user_id, $address_id);
}