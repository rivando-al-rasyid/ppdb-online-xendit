<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPekerjaanOrtu
 * 
 * @property int $id
 * @property string $nama_pekerjaan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblBiodataOrtu[] $tbl_biodata_ortus
 * @property Collection|TblBiodataWali[] $tbl_biodata_walis
 *
 * @package App\Models
 */
class TblPekerjaanOrtu extends Model
{
	protected $table = 'tbl_pekerjaan_ortu';

	protected $fillable = [
		'nama_pekerjaan'
	];

	public function tbl_biodata_ortus()
	{
		return $this->hasMany(TblBiodataOrtu::class, 'id_pekerjaan_ibu');
	}

	public function tbl_biodata_walis()
	{
		return $this->hasMany(TblBiodataWali::class, 'id_pekerjaan_wali');
	}
}
