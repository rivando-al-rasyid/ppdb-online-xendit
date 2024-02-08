<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblBiodataOrtu
 *
 * @property int $id
 * @property int $id_pekerjaan_ayah
 * @property int $id_pekerjaan_ibu
 * @property string $nama_ayah
 * @property string $nama_ibu
 * @property int $no_tlp_ayah
 * @property int $no_tlp_ibu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_peserta_ppdb
 *
 * @property TblPekerjaanOrtu $tbl_pekerjaan_ortu
 * @property TblPesertaPpdb $tbl_peserta_ppdb
 *
 * @package App\Models
 */
class TblBiodataOrtu extends Model
{
    protected $table = 'tbl_biodata_ortu';

    protected $casts = [
        'id_pekerjaan_ayah' => 'int',
        'id_pekerjaan_ibu' => 'int',
        'no_tlp_ayah' => 'int',
        'no_tlp_ibu' => 'int',
        'id_peserta_ppdb' => 'int'
    ];

    protected $fillable = [
        'id_pekerjaan_ayah',
        'id_pekerjaan_ibu',
        'nama_ayah',
        'nama_ibu',
        'no_tlp_ayah',
        'no_tlp_ibu',
        'id_peserta_ppdb'
    ];

    public function tbl_pekerjaan_ortu()
    {
        return $this->belongsTo(TblPekerjaanOrtu::class, 'id_pekerjaan_ibu');
    }

    public function tbl_peserta_ppdb()
    {
        return $this->belongsTo(TblPesertaPpdb::class, 'id_peserta_ppdb');
    }
}
