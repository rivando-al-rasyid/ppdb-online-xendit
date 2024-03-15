<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblFile
 * 
 * @property int $id
 * @property string|null $rapor_semester_9
 * @property string|null $rapor_semester_10
 * @property string|null $rapor_semester_11
 * @property string|null $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
 *
 * @package App\Models
 */
class TblFile extends Model
{
	protected $table = 'tbl_file';

	protected $fillable = [
		'rapor_semester_9',
		'rapor_semester_10',
		'rapor_semester_11',
		'foto'
	];

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_file');
	}
}
