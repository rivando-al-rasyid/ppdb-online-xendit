<?php

namespace Database\Seeders;

use App\Models\TblPekerjaanOrtu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $input_pekerjaan = [
            "Petani",
            "Peternak",
            "Guru/Tutor",
            "Pengelola Usaha Kecil dan Menengah (UKM)",
            "Pengelola Desa Wisata",
            "Petugas Kesehatan",
            "Pengelola Air"
        ];

        foreach ($input_pekerjaan as $pekerjaan) {
            TblPekerjaanOrtu::create([
                'nama_pekerjaan' => $pekerjaan
            ]);
        }
    }
}
