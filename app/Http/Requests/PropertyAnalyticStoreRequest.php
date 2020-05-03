<?php

namespace App\Http\Requests;

class PropertyAnalyticStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'analytic_type_id' => 'required|exists:App\AnalyticType,id',
            'value'            => 'required',
        ];
    }
}
