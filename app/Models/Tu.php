<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tu
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $nip
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Tu extends Model
{
	protected $table = 'tus';

	protected $casts = [
		'nip' => 'int',
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'nip',
		'email_verified_at',
		'password',
		'remember_token'
	];
}
