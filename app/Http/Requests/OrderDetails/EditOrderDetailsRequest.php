<?php

namespace App\Http\Requests\OrderDetails;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderDetailsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.order_details_id' => 'required|numeric',
            'data.client_name' => 'nullable|string',
            'data.order_date' => 'nullable|date',
            'data.delivery_location_id' => 'nullable|numeric',
            'data.delivery_date' => 'nullable|date',
            'data.delivery_status' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Data must be required!',
            'data.order_details_id' => "The order details ID is required!"
        ];
    }
}
