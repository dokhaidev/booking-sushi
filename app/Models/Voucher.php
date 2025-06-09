<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'usage_limit',
        'discount_value',
        'start_date',
        'end_date',
        'status',
        'required_points',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
