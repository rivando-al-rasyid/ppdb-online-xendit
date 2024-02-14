<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * 
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
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
		'pkh' => 'int'
	];

	protected $fillable = [
		'kps',
		'kks',
		'kip',
		'pkh'
	];

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_kartu');
	}
}
