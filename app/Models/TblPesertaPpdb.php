<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPesertaPpdb
 * 
 * @property int $id
 * @property string $nama_depan
 * @property string $nama_belakang
 * @property int $nisn
 * @property int $nik
 * @property int $no_kk
 * @property string $jenis_kelamin
 * @property Carbon $tanggal_lahir
 * @property string $tempat_lahir
 * @property string $agama
 * @property string|null $nilai_rata_rata
 * @property string $asal_sekolah
 * @property string $alamat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $id_user
 * 
 * @property User|null $user
 * @property Collection|TblBiodataOrtu[] $tbl_biodata_ortus
 * @property Collection|TblHasil[] $tbl_hasils
 * @property Collection|TblKartu[] $tbl_kartus
 * @property Collection|TblWali[] $tbl_walis
 *
 * @package App\Models
 */
class TblPesertaPpdb extends Model
{
	protected $table = 'tbl_peserta_ppdb';

	protected $casts = [
		'nisn' => 'int',
		'nik' => 'int',
		'no_kk' => 'int',
		'tanggal_lahir' => 'datetime',
		'id_user' => 'int'
	];

	protected $fillable = [
		'nama_depan',
		'nama_belakang',
		'nisn',
		'nik',
		'no_kk',
		'jenis_kelamin',
		'tanggal_lahir',
		'tempat_lahir',
		'agama',
		'nilai_rata_rata',
		'asal_sekolah',
		'alamat',
		'id_user'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function tbl_biodata_ortus()
	{
		return $this->hasMany(TblBiodataOrtu::class, 'id_peserta_ppdb');
	}

	public function tbl_hasils()
	{
		return $this->hasMany(TblHasil::class, 'nis');
	}

	public function tbl_kartus()
	{
		return $this->hasMany(TblKartu::class, 'id_peserta_ppdb');
	}

	public function tbl_walis()
	{
		return $this->hasMany(TblWali::class, 'id_peserta_ppdb');
	}
}
