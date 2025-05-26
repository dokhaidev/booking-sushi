<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_items;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'customer_id',
        'name',
        'payment_method_id',
        'voucher_id',
        'phone',
        'email',
        'total_price',
        'note',
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
    public function items()
    {
        return $this->hasMany(Order_items::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
