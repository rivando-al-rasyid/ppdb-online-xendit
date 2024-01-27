<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "pembayarans";

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
