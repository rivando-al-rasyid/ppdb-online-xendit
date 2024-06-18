<?php

namespace Database\Seeders;

use App\Models\TblHasil;
use Illuminate\Database\Seeder;

class HasilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nis' => 1,
                'status' => 'MENUNGGU',
            ],
            [
                'nis' => 2,
                'status' => 'DITERIMA',
            ],
            [
                'nis' => 3,
                'status' => 'DITOLAK',
            ],
            [
                'nis' => 4,
                'status' => 'MENUNGGU',
            ],
            [
                'nis' => 5,
                'status' => 'DITERIMA',
            ],
            [
                'nis' => 6,
                'status' => 'DITOLAK',
            ],
            [
                'nis' => 7,
                'status' => 'MENUNGGU',
            ],


        ];

        // Insert the data
        foreach ($data as $item) {
            TblHasil::create($item);
        }
    }
}
