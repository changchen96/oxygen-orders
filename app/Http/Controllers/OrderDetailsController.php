<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetails;

class OrderDetailsController extends Controller
{
    public function index()
    {
        $order_details = OrderDetails::query()->get();

        return $order_details;
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
