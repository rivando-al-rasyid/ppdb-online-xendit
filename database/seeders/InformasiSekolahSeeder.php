<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('informasi_sekolah')->insert([
            'tahun_ajar' => '2023',
            'tanggal_laporan' => '2023-06-01',
            'nama_kepsek' => 'Budi Santoso',
            'nip' => '123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
