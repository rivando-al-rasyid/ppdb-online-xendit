<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'price',
        'item_name',
        'customer_first_name',
        'customer_email',
        'checkout_link',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCustomerFirstNameAttribute()
    {
        return $this->user->name;
    }

    public function getCustomerEmailAttribute()
    {
        return $this->user->email;
    }
}
