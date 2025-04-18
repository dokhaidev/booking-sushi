<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
