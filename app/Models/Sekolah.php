<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sekolah
 * 
 * @property int $id
 * @property string $amount
 * @property string $amount_perempuan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Sekolah extends Model
{
	protected $table = 'sekolahs';

	protected $fillable = [
		'amount',
		'amount_perempuan'
	];
}
