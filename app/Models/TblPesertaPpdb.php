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
 * @property float|null $nilai_rata_rata
 * @property string $asal_sekolah
 * @property string $alamat
 * @property int|null $id_file
 * @property int|null $id_biodata_ortu
 * @property int|null $id_biodata_wali
 * @property int|null $id_kartu
 * @property int|null $id_invoice
 * @property int|null $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblBiodataOrtu|null $tbl_biodata_ortu
 * @property TblBiodataWali|null $tbl_biodata_wali
 * @property TblFile|null $tbl_file
 * @property TblPembayaran|null $tbl_pembayaran
 * @property TblKartu|null $tbl_kartu
 * @property User|null $user
 * @property Collection|TblHasil[] $tbl_hasils
 * @property Collection|TblNilai[] $tbl_nilais
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
		'nilai_rata_rata' => 'float',
		'id_file' => 'int',
		'id_biodata_ortu' => 'int',
		'id_biodata_wali' => 'int',
		'id_kartu' => 'int',
		'id_invoice' => 'int',
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
		'id_file',
		'id_biodata_ortu',
		'id_biodata_wali',
		'id_kartu',
		'id_invoice',
		'id_user'
	];

	public function tbl_biodata_ortu()
	{
		return $this->belongsTo(TblBiodataOrtu::class, 'id_biodata_ortu');
	}

	public function tbl_biodata_wali()
	{
		return $this->belongsTo(TblBiodataWali::class, 'id_biodata_wali');
	}

	public function tbl_file()
	{
		return $this->belongsTo(TblFile::class, 'id_file');
	}

	public function tbl_pembayaran()
	{
		return $this->belongsTo(TblPembayaran::class, 'id_invoice');
	}

	public function tbl_kartu()
	{
		return $this->belongsTo(TblKartu::class, 'id_kartu');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function tbl_hasils()
	{
		return $this->hasMany(TblHasil::class, 'nis');
	}

	public function tbl_nilais()
	{
		return $this->hasMany(TblNilai::class, 'id_peserta_ppdb');
	}
}
