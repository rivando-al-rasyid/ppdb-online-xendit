<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "kartus";

    public function peserta()
    {
        return $this->belongsTo(PesertaPPDB::class, 'id_peserta_ppdb');
    }
}
