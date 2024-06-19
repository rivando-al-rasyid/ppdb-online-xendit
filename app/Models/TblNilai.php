<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblNilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_peserta_ppdb',
        'nilai_mtk_5_1',
        'nilai_ipa_5_1',
        'nilai_bi_5_1',
        'nilai_mtk_5_2',
        'nilai_ipa_5_2',
        'nilai_bi_5_2',
        'nilai_mtk_6_1',
        'nilai_ipa_6_1',
        'nilai_bi_6_1',
    ];
    public function peserta_ppdb()
    {
        return $this->belongsTo(TblPesertaPpdb::class);
    }
}
