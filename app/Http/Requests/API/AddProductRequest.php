<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class AddProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id'
        ];
    }
}
