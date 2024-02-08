<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblWali
 * 
 * @property int $id
 * @property int|null $id_pekerjaan_wali
 * @property string|null $nama_wali
 * @property int|null $no_tlp_wali
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_peserta_ppdb
 * 
 * @property TblPekerjaanOrtu|null $tbl_pekerjaan_ortu
 * @property TblPesertaPpdb $tbl_peserta_ppdb
 *
 * @package App\Models
 */
class TblWali extends Model
{
	protected $table = 'tbl_wali';

	protected $casts = [
		'id_pekerjaan_wali' => 'int',
		'no_tlp_wali' => 'int',
		'id_peserta_ppdb' => 'int'
	];

	protected $fillable = [
		'id_pekerjaan_wali',
		'nama_wali',
		'no_tlp_wali',
		'id_peserta_ppdb'
	];

	public function tbl_pekerjaan_ortu()
	{
		return $this->belongsTo(TblPekerjaanOrtu::class, 'id_pekerjaan_wali');
	}

	public function tbl_peserta_ppdb()
	{
		return $this->belongsTo(TblPesertaPpdb::class, 'id_peserta_ppdb');
	}
}
