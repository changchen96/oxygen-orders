<?php

namespace App\Http\Requests\OrderDetails;

use Illuminate\Foundation\Http\FormRequest;

class ListOrderDetailsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_date_start' => 'nullable|date',
            'order_date_end' => 'nullable|date',
            'delivery_location_id' => 'nullable|numeric',
            'delivery_date_start' => 'nullable|date',
            'delivery_date_end' => 'nullable|date',
            'delivery_status' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'client_name' => 'Client name must be a string!',
            'order_date_start.date' => 'Order start date must be a date!',
            'order_date_end.date' => 'Order end date must be a date!',
            'delivery_location_id.numeric' => "Location ID must be a number!",
            'delivery_date_start.date' => "Delivery start date must be a date!",
            'delivery_date_end.date' => "Delivery end date must be a date!",
            'delivery_status.numeric' => "Delivery status ID must be a number!",
        ];
    }
}
