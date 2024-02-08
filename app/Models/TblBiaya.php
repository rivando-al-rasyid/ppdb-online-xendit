<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblBiaya
 * 
 * @property int $id
 * @property string $amount_laki
 * @property string $amount_perempuan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TblBiaya extends Model
{
	protected $table = 'tbl_biaya';

	protected $fillable = [
		'amount_laki',
		'amount_perempuan'
	];
}
