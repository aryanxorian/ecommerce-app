<?php

namespace EcommerceApp\Services\Product;

use EcommerceApp\Models\Cart;
use EcommerceApp\Repository\Product\ProductRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductService implements ProductInterface
{
    public function add($product)
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        $addProduct = $productRepo->add($product);
        return $addProduct;
    }

    public function list($id = null)
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        $listProduct = $productRepo->list($id);
        return $listProduct;
    }

    public function delete($id)
    {
        $payload = JWTAuth::payload();
        if($id == $payload['sub'])
        {
            $productRepo = resolve(ProductRepositoryInterface::class);
            return $productRepo->delete($id);
        }

        return false;
        
    }

    public function search($key)
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        return $productRepo->search($key);
    }
}