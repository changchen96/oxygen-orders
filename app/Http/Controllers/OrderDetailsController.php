<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderDetails\AddOrderDetailsRequest;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetails;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderDetailsController extends Controller
{
    public function index(AddOrderDetailsRequest $req)
    {
        try{
            $order_details = OrderDetails::query();

            $client_name = $req->input('client_name');
            $order_date_start = $req->input('order_date_start');
            $order_date_end = $req->input('order_date_end');
            
            if (!empty($client_name))
            {
                $order_details = $order_details->where('client_name', $client_name);
            }

            if (!empty($order_date_start) && !empty($order_date_end));
            {
                $order_details = $order_details->whereBetween('order_date', [$order_date_start, $order_date_end]);
            }

            return $order_details->get();
        }
        catch(HttpResponseException $e){
           return response()->json([
            'data' => [
                'message' => $e->getMessage()
            ]
        ]);
        }
    }

    public function add(Request $req)
    {

    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}
