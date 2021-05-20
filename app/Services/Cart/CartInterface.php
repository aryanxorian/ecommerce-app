<?php

namespace EcommerceApp\Services\Cart;

interface CartInterface
{
    public function add($request);
    public function view($id);
}