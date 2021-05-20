<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Http\Requests\ProductRequest;
use EcommerceApp\Services\Response\ResponseService;
use EcommerceApp\Services\Product\ProductInterface;
use EcommerceApp\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(ProductRequest $request, ProductInterface $productService)
    {
        $product = $request->validated();
        $file = $request->file('file')->store('products');
        $product['file'] = $file;
        $productData = $productService->add($product);

        if($productData)
        {
            return ResponseService::productAddedSuccessfullResponse($request->all());
        }
        
        return ResponseService::internalServerErrorResponse(null);
    }

    public function listProduct($id=null, ProductInterface $productService)
    {
        $listProduct = $productService->list($id);
        
        if($listProduct)
        {
            ResponseService::listProductSuccessfullResponse($listProduct);
        }

        return ResponseService::internalServerErrorResponse(null);
    }

    public function deleteProduct($id, ProductInterface $productService)
    {
        if($productService->delete($id))
        {
            return ResponseService::productDeletedSuccessfullResponse(null);
        }
        
        return ResponseService::internalServerErrorResponse(null);
    }

    public function searchProduct($key, ProductInterface $productService)
    {
        $searchDetails = $productService->search($key);
        if($searchDetails->count() > 0)
        {
            return $searchDetails;
        }

        return ResponseService::searchErrorResponse(null);
    }
}