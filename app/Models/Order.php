<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',  // ✅ Now allows mass assignment
        'name',
        'email',
        'address',
        'payment_method',
        'total_price',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure 'user_id' is the foreign key
    }
}
