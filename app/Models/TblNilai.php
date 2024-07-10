<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblNilai
 * 
 * @property int $id
 * @property int $id_peserta_ppdb
 * @property float|null $nilai_mtk_5_1
 * @property float|null $nilai_ipa_5_1
 * @property float|null $nilai_bi_5_1
 * @property float|null $nilai_mtk_5_2
 * @property float|null $nilai_ipa_5_2
 * @property float|null $nilai_bi_5_2
 * @property float|null $nilai_mtk_6_1
 * @property float|null $nilai_ipa_6_1
 * @property float|null $nilai_bi_6_1
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblPesertaPpdb $tbl_peserta_ppdb
 *
 * @package App\Models
 */
class TblNilai extends Model
{
	protected $table = 'tbl_nilais';

	protected $casts = [
		'id_peserta_ppdb' => 'int',
		'nilai_mtk_5_1' => 'float',
		'nilai_ipa_5_1' => 'float',
		'nilai_bi_5_1' => 'float',
		'nilai_mtk_5_2' => 'float',
		'nilai_ipa_5_2' => 'float',
		'nilai_bi_5_2' => 'float',
		'nilai_mtk_6_1' => 'float',
		'nilai_ipa_6_1' => 'float',
		'nilai_bi_6_1' => 'float'
	];

	protected $fillable = [
		'id_peserta_ppdb',
		'nilai_mtk_5_1',
		'nilai_ipa_5_1',
		'nilai_bi_5_1',
		'nilai_mtk_5_2',
		'nilai_ipa_5_2',
		'nilai_bi_5_2',
		'nilai_mtk_6_1',
		'nilai_ipa_6_1',
		'nilai_bi_6_1'
	];

	public function tbl_peserta_ppdb()
	{
		return $this->belongsTo(TblPesertaPpdb::class, 'id_peserta_ppdb');
	}
}
