<?php

namespace EcommerceApp\Checkout;

interface PaymentInterface
{
    public function pay($amount);
}
?>
