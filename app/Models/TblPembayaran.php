<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPembayaran
 * 
 * @property int $id
 * @property string $invoice_id
 * @property string $external_id
 * @property string $payer_email
 * @property string $description
 * @property int $amount
 * @property string $status
 * @property string $checkout_link
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class TblPembayaran extends Model
{
	protected $table = 'tbl_pembayaran';

	protected $casts = [
		'amount' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'external_id',
		'payer_email',
		'description',
		'amount',
		'status',
		'checkout_link',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
