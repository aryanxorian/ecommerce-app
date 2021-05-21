<?php

namespace EcommerceApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | string | min:3',
            'mobile' => 'required | min:8',
            'pincode' => 'required | integer | min:6',
            'state' => 'required | string | min:4',
            'city' => 'required | string | min:4',
            'area' => 'required | string',
            'type' => 'required | string'
        ];
    }
}
