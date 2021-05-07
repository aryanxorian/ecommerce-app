<?php
namespace App\Checkout;

class Stripe implements PaymentInterface
{
    private $currency;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function pay($amount)
    {
        return [
            'amount'=> $amount,
            'currency'=>$this->currency,
            'method'=>'Stripe',
        ];
    }
}

?>