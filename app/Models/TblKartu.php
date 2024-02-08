<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblKartu
 * 
 * @property int $id
 * @property int|null $kps
 * @property int|null $kks
 * @property int|null $kip
 * @property int|null $pkh
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_peserta_ppdb
 * 
 * @property TblPesertaPpdb $tbl_peserta_ppdb
 *
 * @package App\Models
 */
class TblKartu extends Model
{
	protected $table = 'tbl_kartu';

	protected $casts = [
		'kps' => 'int',
		'kks' => 'int',
		'kip' => 'int',
		'pkh' => 'int',
		'id_peserta_ppdb' => 'int'
	];

	protected $fillable = [
		'kps',
		'kks',
		'kip',
		'pkh',
		'id_peserta_ppdb'
	];

	public function tbl_peserta_ppdb()
	{
		return $this->belongsTo(TblPesertaPpdb::class, 'id_peserta_ppdb');
	}
}
