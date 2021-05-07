<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Checkout\PaymentInterface;
use EcommerceApp\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(PaymentInterface $payment)
    {
        // $payment = new Payment('Rupee');
        dd($payment->pay(2000));
    }
}
