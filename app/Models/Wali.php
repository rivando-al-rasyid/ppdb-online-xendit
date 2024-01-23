<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;
    protected $table = "tbl_biodata_ortu";

    public function peserta()
    {
        return $this->belongsTo(PesertaPPDB::class, 'id_peserta_ppdb');
    }

    public function pekerjaan_wali()
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'id_pekerjaan_wali');
    }


}
