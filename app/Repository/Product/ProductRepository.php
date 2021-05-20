<?php

namespace EcommerceApp\Repository\Product;
use EcommerceApp\Repository\Product\ProductRepositoryInterface;
use EcommerceApp\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function add($productData)
    {
        // $product = new Product();
        $this->product->user_id = $productData['user_id'];
        $this->product->name = $productData['name'];
        $this->product->file_path = $productData['file'];
        $this->product->description = $productData['description'];
        $this->product->price = $productData['price'];
        $this->product->quantity = $productData['quantity'];
        $this->product->save();
        return $this->product;
    }

    public function list($id= null)
    {
        return $id?Product::find($id):Product::all();
    }

    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function search($key)
    {
        return Product::where('name','Like',"%$key%")->get();
    }
}