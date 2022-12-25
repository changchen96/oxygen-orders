<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetails;

class Orders extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['order_details_id', 'client_name', 'delivery_location_id', 'delivery_date'];

    public $timestamps = false;

    public static function populateForOrderInsert($order_date, $new_order_id, $client_name, $delivery_location_id)
    {
        $data_insert_orders = [
            'order_date' => Carbon::parse($order_date),
            'order_details_id' => $new_order_id,
            'client_name' => $client_name,
            'delivery_location_id' => $delivery_location_id,
            'delivery_date' => Carbon::parse($order_date)->addDays(7)
        ];

        return $data_insert_orders;
    }

}
