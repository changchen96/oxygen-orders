<?php

namespace App\Http\Requests\OrderDetailsItem;

use App\Http\Requests\AbstractRequest;

class ListOrderDetailsItemRequest extends AbstractRequest
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
            'order_details_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'order_details_id.required' => 'Order details ID is required!',
            'order_details_id.numeric' => 'Order details ID must be a number!'
        ];
    }
}
