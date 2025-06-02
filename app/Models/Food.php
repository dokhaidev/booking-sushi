<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

protected $table = 'foods';
    protected $fillable = [
        'name', 'price', 'category_id', 'status', 'image' ,'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
