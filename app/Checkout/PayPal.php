<?php
namespace App\Checkout;

class PayPal implements PaymentInterface
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
            'method'=>'PayPal',
        ];
    }
}

?>