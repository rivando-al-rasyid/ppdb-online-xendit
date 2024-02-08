<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblHasil
 * 
 * @property int $id
 * @property int $nis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $status
 * 
 * @property TblPesertaPpdb $tbl_peserta_ppdb
 *
 * @package App\Models
 */
class TblHasil extends Model
{
	protected $table = 'tbl_hasil';

	protected $casts = [
		'nis' => 'int'
	];

	protected $fillable = [
		'nis',
		'status'
	];

	public function tbl_peserta_ppdb()
	{
		return $this->belongsTo(TblPesertaPpdb::class, 'nis');
	}
}
