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
            "UKM",
            "Pengelola Desa Wisata",
            "Petugas Kesehatan",
            "Pengelola Air",
            "Dokter",
            "Insinyur",
            "Polisi",
            "Tentara",
            "Pengacara",
            "Aktor/Aktris",
            "Musisi",
            "Penulis",
            "Pengusaha",
            "Arsitek",
            "Desainer Grafis",
            "Teknisi IT",
            "Koki",
            "Pelayan",
            "Sopir",
            "Mekanik",
            "Pekerja Pabrik",
            "Penjaga Toko",
            "Satpam",
            "Pustakawan",
            "Dosen",
            "Peneliti",
            "Fotografer"
        ];

        foreach ($input_pekerjaan as $pekerjaan) {
            TblPekerjaanOrtu::create([
                'nama_pekerjaan' => $pekerjaan
            ]);
        }
    }
}
