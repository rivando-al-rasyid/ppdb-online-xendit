<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblFileRapor
 * 
 * @property int $id
 * @property string|null $link_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
 *
 * @package App\Models
 */
class TblFileRapor extends Model
{
	protected $table = 'tbl_file_rapor';

	protected $fillable = [
		'link_file'
	];

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_file_rapor');
	}
}
