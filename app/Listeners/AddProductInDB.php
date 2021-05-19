<?php

namespace EcommerceApp\Listeners;

use EcommerceApp\Events\AddProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddProductInDB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddProduct  $event
     * @return void
     */
    public function handle(AddProduct $event)
    {
        $product = $event->getProduct();
        $file = $event->getFile();
        $saveHistory = DB::table('products')->insert(
            [
                'name' => $product['name'], 'file_path' => $file, 'description' => $product['description'], 'price' => $product['price'], 'quantity' => $product['quantity']
        ]);
        return $saveHistory;
    }
}
