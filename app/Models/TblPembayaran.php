<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPembayaran
 * 
 * @property int $id
 * @property string $invoice_id
 * @property string $external_id
 * @property string $description
 * @property int $amount
 * @property string $status
 * @property string $checkout_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblPesertaPpdb[] $tbl_peserta_ppdbs
 *
 * @package App\Models
 */
class TblPembayaran extends Model
{
	protected $table = 'tbl_pembayaran';

	protected $casts = [
		'amount' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'external_id',
		'description',
		'amount',
		'status',
		'checkout_link'
	];

	public function tbl_peserta_ppdbs()
	{
		return $this->hasMany(TblPesertaPpdb::class, 'id_invoice');
	}
}
