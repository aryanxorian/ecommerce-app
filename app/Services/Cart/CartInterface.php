<?php

namespace EcommerceApp\Services\Cart;

interface CartInterface
{
    public function add($cart);
    public function view();
}