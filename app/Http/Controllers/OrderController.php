<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetails\AddOrderDetailsRequest;
use App\Http\Requests\OrderDetails\EditOrderDetailsRequest;
use App\Http\Requests\OrderDetails\ListOrderDetailsRequest;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use Exception;

class OrderController extends Controller
{
    public function index(ListOrderDetailsRequest $req)
    {
        try{
            $orders = Orders::query()->join('location_detail', 'location_detail.id', 'orders.delivery_location_id');

            $client_name = $req->input('client_name');
            $order_date_start = $req->input('order_date_start');
            $order_date_end = $req->input('order_date_end');
            $delivery_date_start = $req->input('delivery_date_start');
            $delivery_date_end = $req->input('delivery_date_end');
            $location_id = $req->input('location_id');
            $delivery_status = $req->input('delivery_status');

            if (!is_null($client_name))
            {
                $orders = $orders->where('client_name', $client_name);
            }

            if (!is_null($location_id))
            {
                $orders = $orders->where('location_id', $location_id);
            }

            if (!is_null($delivery_status))
            {
                $orders = $orders->where('delivery_status', $delivery_status);
            }

            if (!empty($order_date_start) && !empty($order_date_end))
            {
                $orders = $orders->whereBetween('order_date', [$order_date_start, $order_date_end]);
            }

            if (!empty($delivery_date_start) && !empty($delivery_date_end))
            {
                $orders = $orders->whereBetween('delivery_date', [$delivery_date_start, $delivery_date_end]);
            }

            //TODO: create custom paginator
            $orders_result = $orders->paginate(10);

            return $orders_result;
           
        }
        catch(Exception $e){
           return response()->json([
            'data' => [
                'message' => $e->getMessage()
            ]
        ], 500);
        }
    }

    public function add(AddOrderDetailsRequest $req)
    {
        try {
            $client_name = $req->input('data.client_name');
            $delivery_location_id = $req->input('data.delivery_location_id');
            $order_date = $req->input('data.order_date');
            $order_array = $req->input('data.items');

            $order_id = OrderDetails::max('order_id');

            $new_order_id = $order_id + 1;

            $data_insert_order_details = OrderDetails::populateForOrderDetailsInsert($order_array, $new_order_id, $order_date);

            $data_insert_orders = Orders::populateForOrderInsert($order_date, $new_order_id, $client_name, $delivery_location_id);

            $order_details = OrderDetails::insert($data_insert_order_details);
            $orders = Orders::insert($data_insert_orders);

            return response()->json([
                'data' => [
                    'order_details_insert_status' => $order_details,
                    'orders_insert_status' => $orders
                ]
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'data' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }

    }

    public function update(EditOrderDetailsRequest $req)
    {
        try {
            $order_details_id = $req->input('data.order_details_id');
            $client_name = $req->input('data.client_name');
            $delivery_location_id = $req->input('data.delivery_location_id');
            $delivery_date = $req->input('data.delivery_date');
            $delivery_status = $req->input('data.delivery_status');

            $data_save = [];

            $data_save['order_details_id'] = $order_details_id;

            if (!is_null($client_name))
            {
                $data_save['client_name'] = $client_name;
            }

            if (!is_null($delivery_location_id))
            {
                $data_save['delivery_location_id'] = $delivery_location_id;
            }

            if (!is_null($delivery_date))
            {
                $data_save['delivery_date'] = $delivery_date;
            }

            if (!is_null($delivery_status))
            {
                $data_save['delivery_status'] = $delivery_status;
            }

            $order_update_status = Orders::query()->where('order_details_id', $order_details_id)->update($data_save);

            return response()->json([
                'data' => [
                    'order_update_status' => $order_update_status
                ]
            ]);
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
