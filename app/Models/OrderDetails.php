<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OrderDetails extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public static function populateForOrderDetailsInsert(Array $order_array, $new_order_id, $order_date)
    {
        $data_insert_order_details = [];
        foreach ($order_array as $order)
        {
            $data = [
                'order_id' => $new_order_id,
                'product_id' => $order['product_id'],
                'quantity' => $order['quantity'],
                'order_date' => Carbon::parse($order_date)
            ];
            array_push($data_insert_order_details, $data);
        }

        return $data_insert_order_details;
    }
}
