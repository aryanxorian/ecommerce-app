<?php

namespace EcommerceApp\Repository\Cart;

interface CartRepositoryInterface
{
    public function add($cartData);
    public function view($id);
}