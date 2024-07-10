<?php

namespace Database\Seeders;

use App\Models\InformasiSekolah;
use Illuminate\Database\Seeder;

class InformasiSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformasiSekolah::create([
            'tahun_ajar' => '2023',
            'tanggal_laporan' => '2023-06-01',
            'nama_kepsek' => 'Budi Santoso',
            'nip' => '123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
