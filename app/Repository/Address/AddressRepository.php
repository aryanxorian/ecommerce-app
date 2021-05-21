<?php

namespace EcommerceApp\Repository\Address;

use EcommerceApp\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    private $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function add($addressDetails)
    {
        $this->address->user_id = $addressDetails['user_id'];
        $this->address->name = $addressDetails['name'];
        $this->address->mobile = $addressDetails['mobile'];
        $this->address->pincode = $addressDetails['pincode'];
        $this->address->state = $addressDetails['state'];
        $this->address->city = $addressDetails['city'];
        $this->address->area = $addressDetails['area'];
        $this->address->type = $addressDetails['type'];
        $this->address->save();

        return $this->address;
    }
    public function view($user_id, $id)
    {
        $address = $id?Address::where('user_id', $user_id)
                    ->where('id', $id)->get():Address::where('user_id', $user_id)->get();

        return $address;
    }

    public function delete($user_id, $id)
    {
        $deleteAddress = $id?Address::where('user_id', $user_id)
        ->where('id', $id)->delete():Address::where('user_id', $user_id)->delete();

        return $deleteAddress;
    }
}