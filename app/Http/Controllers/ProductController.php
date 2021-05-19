<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Events\AddProduct;
use EcommerceApp\Http\Requests\ProductRequest;
use EcommerceApp\Models\Product;
use EcommerceApp\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function addProduct(ProductRequest $request)
    {
        $product = $request->validated();
        $file = $request->file('file')->store('products');
        $saveHistory = AddProduct::dispatch($product,$file);
        if($saveHistory)
        {
            return ResponseService::successResponse($product,'Product added Successfully');
        }
        else
        {
            return ResponseService::internalServerError(null,'Product could not be added');
        }
    }

    public function listProduct($id=null)
    {
        return $id?Product::find($id):Product::all();
    }

    public function deleteProduct($id)
    {
        if(Product::where('id', $id)->delete())
        {
            return ResponseService::successResponse(null,'Product Deleted Successfully');
        }
        else
        {
            return ResponseService::errorResponse(null,'Product cannot be deleted');
        }
    }

    public function searchProduct($key)
    {
        return Product::where('name','Like',"%$key%")->get();
    }
}
