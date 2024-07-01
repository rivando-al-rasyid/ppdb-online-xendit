<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InformasiSekolah
 *
 * @property int $id
 * @property int $tahun_ajar
 * @property Carbon $tanggal_laporan
 * @property string $nama_kepsek
 * @property int $nip
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class InformasiSekolah extends Model
{
    protected $table = 'informasi_sekolahs';

    protected $casts = [
        'tahun_ajar' => 'int',
        'tanggal_laporan' => 'datetime',
        'nip' => 'int'
    ];

    protected $fillable = [
        'tahun_ajar',
        'tanggal_laporan',
        'nama_kepsek',
        'nip'
    ];
}
