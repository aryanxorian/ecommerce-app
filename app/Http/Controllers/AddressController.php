<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Http\Requests\AddressRequest;
use EcommerceApp\Services\Address\AddressInterface;
use EcommerceApp\Services\Response\ResponseService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function addAddress(AddressRequest $request, AddressInterface $address)
    {
        $addressDetails = $request->validated();
        $addressData = $address->add($addressDetails);

        if($addressData)
            return ResponseService::addessAddedSuccessfullResponse($addressData);
        
        return ResponseService::internalServerErrorResponse(null);
    }

    public function viewAddress($id=null, AddressInterface $address)
    {
        $viewAddress = $address->view($id);

        if($viewAddress)
            return ResponseService::viewAddressSuccessfullResponse($viewAddress);

        return ResponseService::interServerErrorResponse(null);
    }

    public function deleteAddress($id=null, AddressInterface $address)
    {
        $deleteAddress = $address->delete($id);

        if($deleteAddress)
            return ResponseService::addressDeletedResponse(null);

        return ResponseService::internalServerErrorResponse(null);
    }
}
