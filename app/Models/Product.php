<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'discount_price', 'quantity', 'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
