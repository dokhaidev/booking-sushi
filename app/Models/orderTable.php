<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderTable extends Model
{
       protected $fillable = [
        'order_id',
        'table_id',
        'reservation_date',
        'reservation_time',
    ];

}
