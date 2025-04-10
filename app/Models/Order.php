<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'customer_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'total_price',
        'status',
        'reservation_date',
        'reservation_time',
        'guests',
    ];


    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
