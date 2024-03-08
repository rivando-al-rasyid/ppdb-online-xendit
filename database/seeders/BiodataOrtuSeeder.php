<?php

namespace Database\Seeders;

use App\Models\TblBiodataOrtu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiodataOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [
            [
                'id_pekerjaan_ayah' => 1,
                'id_pekerjaan_ibu' => 2,
                'nama_ayah' => 'John Doe',
                'nama_ibu' => 'Jane Doe',
                'no_tlp_ayah' => 123456789,
                'no_tlp_ibu' => 987654321,
            ],
            // Add more sample data as needed
        ];

        // Insert the data
        foreach ($data as $item) {
            TblBiodataOrtu::create($item);
        }
    }
}
