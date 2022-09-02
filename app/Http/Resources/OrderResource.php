<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer = Customer::findOrFail($this->customer_id);

        return [
            'id' => $this->id,
            'customer' => $customer->name,
            'payed' => $this->payed,
            'created_at' => $this->created_at->format('l, d-M-Y')
        ];
    }
}
