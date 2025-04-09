<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $fillable = [
        'name', 'price', 'category_id', 'price', 'status', 'image'
    ];
}
