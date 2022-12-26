<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Requests\OrderDetailsItem\ListOrderDetailsItemRequest;
use Exception;

class OrderDetailsItemController extends Controller
{
    public function index(ListOrderDetailsItemRequest $req)
    {
        try {
            $order_details_id = $req->input('order_details_id');
            $order_details = OrderDetails::join('product_details', 'product_details.id', 'order_details.product_id')->where('order_id', $order_details_id)->paginate(10);

            return $order_details;
        }
        catch (Exception $e){
            return response()->json([
                'data' => [
                'message' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
