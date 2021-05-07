<?php

namespace App\Checkout;

interface PaymentInterface
{
    public function pay($amount);
}
?>