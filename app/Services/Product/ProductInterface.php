<?php

namespace EcommerceApp\Services\Product;

interface ProductInterface
{
    public function add($request);
    public function list($id = null);
    public function delete($id);
    public function search($key);
}