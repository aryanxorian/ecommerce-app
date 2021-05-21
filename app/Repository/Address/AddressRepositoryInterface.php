<?php

namespace EcommerceApp\Repository\Address;

interface AddressRepositoryInterface
{
    public function add($addressData);
    public function view($user_id, $id);
    public function delete($user_id, $id);
}