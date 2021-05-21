<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Http\Requests\CartRequest;
use EcommerceApp\Services\Cart\CartInterface;
use EcommerceApp\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    /**
     * 
     * 
     */
    public function addItem(CartRequest $request, CartInterface $item)
    {
        $cart = $request->validated();
        $cartData = $item->add($cart);

        if($cartData)
        {
            return ResponseService::itemAddedSuccessfullResponse($cartData);
        }

        return ResponseService::internalServerErrorResponse(null);
    }

    public function viewCart(CartInterface $item)
    {
        $viewCart = $item->view();
        
        if($viewCart)
        {
            return ResponseService::cartDetailsSuccessfullResponse($viewCart);
        }

        return ResponseService::internalServerErrorResponse(null);
    }
}
