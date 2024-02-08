<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * 
 * @property TblPekerjaanOrtu $tbl_pekerjaan_ortu
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
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
		'no_tlp_ibu' => 'int'
	];

	protected $fillable = [
		'id_pekerjaan_ayah',
		'id_pekerjaan_ibu',
		'nama_ayah',
		'nama_ibu',
		'no_tlp_ayah',
		'no_tlp_ibu'
	];

	public function tbl_pekerjaan_ortu()
	{
		return $this->belongsTo(TblPekerjaanOrtu::class, 'id_pekerjaan_ibu');
	}

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_biodata_ortu');
	}
}
