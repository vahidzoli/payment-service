<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class OrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'payed' => 'boolean'
        ];
    }
}
