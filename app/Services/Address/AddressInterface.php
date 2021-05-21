<?php

namespace EcommerceApp\Services\Address;

interface AddressInterface
{
    public function add($address);
    public function view($id);
    public function delete($id);
}