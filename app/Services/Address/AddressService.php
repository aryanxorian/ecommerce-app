<?php

namespace EcommerceApp\Services\Address;

use EcommerceApp\Repository\Address\AddressRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class AddressService implements AddressInterface
{
    public function add($addressDetails)
    {
        $payload = JWTAuth::payload();
        $addressDetails['user_id'] = $payload['sub'];

        $addressRepo = resolve(AddressRepositoryInterface::class);
        $addressAdded = $addressRepo->add($addressDetails);

        if($addressAdded)
            return $addressAdded;
            
        return false;
    }
    public function view($id)
    {
        $payload = JWTAuth::payload();

        $addressRepo = resolve(AddressRepositoryInterface::class);
        $viewAddress = $addressRepo->view($payload['sub'], $id);

        if($viewAddress)
            return $viewAddress;

        return false;
    }

    public function delete($id)
    {
        $payload = JWTAuth::payload();

        $addressRepo = resolve(AddressRepositoryInterface::class);
        $deleteAddress = $addressRepo->delete($payload['sub'], $id);

        if($deleteAddress)
            return true;
            
        return false;
    }
}