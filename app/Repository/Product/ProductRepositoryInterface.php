<?php

namespace EcommerceApp\Repository\Product;

interface ProductRepositoryInterface
{
    public function add($productData);
    public function list($id = null);
    public function delete($id);
    public function search($key);
}