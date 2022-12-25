<?php

namespace App\Http\Requests\OrderDetails;

use App\Http\Requests\AbstractRequest;

class AddOrderDetailsRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.client_name' => 'required|string',
            'data.order_date' => 'required|date',
            'data.delivery_location' => 'required|string',
            'data.items' => 'required|array',
            'data.items.*.product_id' => 'required|numeric',
            'data.items.*.quantity' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'client_name.required' => 'Client name is required!',
            'order_date.required' => 'Order date is required and must be a date!',
            'delivery_location' => 'Delivery location is required!',
            'items.required' => 'Item list is required!',
        ];
    }
    
}
