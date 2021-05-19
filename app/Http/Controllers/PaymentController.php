<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Http\Controllers\Controller;
use EcommerceApp\Services\Payment\PaymentService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function checkout(PaymentService $payment)
    {
        // $payment = new Payment('Rupee');
        dd($payment->pay(2000));
    }
}
