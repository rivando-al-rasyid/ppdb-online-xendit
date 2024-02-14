<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblBiodataWali
 * 
 * @property int $id
 * @property int|null $id_pekerjaan_wali
 * @property string|null $nama_wali
 * @property int|null $no_tlp_wali
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblPekerjaanOrtu|null $tbl_pekerjaan_ortu
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
 *
 * @package App\Models
 */
class TblBiodataWali extends Model
{
	protected $table = 'tbl_biodata_wali';

	protected $casts = [
		'id_pekerjaan_wali' => 'int',
		'no_tlp_wali' => 'int'
	];

	protected $fillable = [
		'id_pekerjaan_wali',
		'nama_wali',
		'no_tlp_wali'
	];

	public function tbl_pekerjaan_ortu()
	{
		return $this->belongsTo(TblPekerjaanOrtu::class, 'id_pekerjaan_wali');
	}

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_biodata_wali');
	}
}
