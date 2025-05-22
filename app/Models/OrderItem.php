<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'food_id',
        'combo_id',
        'status',
        'quantity',
        'price',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Mỗi OrderItem thuộc về một Menu (món ăn)
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
