<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'food_id',
        'status',
        'quantity',
        'price',
        'combo_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Mỗi OrderItem thuộc về một Food (món ăn)
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
    public function comboItem(): BelongsTo
    {
        return $this->belongsTo(Combo::class, 'combo_item_id');
    }
}
