<?php

namespace App\Http\Requests;

class PropertyStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'suburb'  => 'required',
            'state'   => 'required',
            'country' => 'required',
        ];
    }
}
