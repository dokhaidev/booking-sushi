<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'size',
        'max_guests',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function orderTables()
    {
        return $this->hasMany(\App\Models\orderTable::class, 'table_id', 'id');
    }
}
