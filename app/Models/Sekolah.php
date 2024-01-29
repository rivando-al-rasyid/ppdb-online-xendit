<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deskripsi',
        'email',
        'phone',
        'amount',
        'deskripsi_tagihan',

        // Add other fillable fields as needed
    ];
}
