<?php

namespace App\Http\Requests;

class CreateapartmentRequest extends Request
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
            //   'title' => 'required',
            // 'content' => 'required',
//            'town' => 'required',
//            'street' => 'required',
//            'city' => 'required|not_in:null',
//            'country' => 'required|not_in:null',
//            'moveInDate' => 'required',
//            'email' => 'required|email',
//            'postalCode' => 'required|integer',

        ];
    }
}
