<?php

namespace Database\Seeders;

use App\Models\TblPesertaPpdb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaPpdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'nisn' => 1234567890,
                'nik' => 9876543210,
                'no_kk' => 123456789,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-01-01',
                'tempat_lahir' => 'Jakarta',
                'agama' => 'Islam',
                'nilai_rata_rata' => 85.5,
                'asal_sekolah' => 'SMP Negeri 1 Jakarta',
                'alamat' => 'Jl. Jendral Sudirman No. 123, Jakarta',
                'id_biodata_ortu' => 1,
                'id_user' => 1,

            ],
            // Add more sample data as needed
        ];

        // Insert the data
        foreach ($data as $item) {
            TblPesertaPpdb::create($item);
        }
    }
}
