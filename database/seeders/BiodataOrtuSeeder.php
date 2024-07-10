<?php

namespace Database\Seeders;

use App\Models\TblBiodataOrtu;
use Illuminate\Database\Seeder;

class BiodataOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_pekerjaan_ayah' => 1,
                'id_pekerjaan_ibu' => 2,
                'nama_ayah' => 'John Doe',
                'nama_ibu' => 'Jane Doe',
                'no_tlp_ayah' => 123456789,
                'no_tlp_ibu' => 987654321,
            ],
            [
                'id_pekerjaan_ayah' => 3,
                'id_pekerjaan_ibu' => 4,
                'nama_ayah' => 'Hasudungan Simanjuntak',
                'nama_ibu' => 'Maria Simanjuntak',
                'no_tlp_ayah' => 123456788,
                'no_tlp_ibu' => 987654320,
            ],
            [
                'id_pekerjaan_ayah' => 5,
                'id_pekerjaan_ibu' => 6,
                'nama_ayah' => 'Raja Sitorus',
                'nama_ibu' => 'Ribka Sitorus',
                'no_tlp_ayah' => 123456787,
                'no_tlp_ibu' => 987654319,
            ],
            [
                'id_pekerjaan_ayah' => 7,
                'id_pekerjaan_ibu' => 8,
                'nama_ayah' => 'Fernando Lumban Gaol',
                'nama_ibu' => 'Yohana Lumban Gaol',
                'no_tlp_ayah' => 123456786,
                'no_tlp_ibu' => 987654318,
            ],
            [
                'id_pekerjaan_ayah' => 9,
                'id_pekerjaan_ibu' => 10,
                'nama_ayah' => 'Yusuf Nasution',
                'nama_ibu' => 'Nadia Nasution',
                'no_tlp_ayah' => 123456785,
                'no_tlp_ibu' => 987654317,
            ],
            [
                'id_pekerjaan_ayah' => 11,
                'id_pekerjaan_ibu' => 12,
                'nama_ayah' => 'Rafli Harahap',
                'nama_ibu' => 'Siti Harahap',
                'no_tlp_ayah' => 123456784,
                'no_tlp_ibu' => 987654316,
            ],
            [
                'id_pekerjaan_ayah' => 13,
                'id_pekerjaan_ibu' => 14,
                'nama_ayah' => 'Syahrul Siregar',
                'nama_ibu' => 'Syafira Siregar',
                'no_tlp_ayah' => 123456783,
                'no_tlp_ibu' => 987654315,
            ],

            // Continue adding more entries as needed
        ];

        // Insert the data
        foreach ($data as $item) {
            TblBiodataOrtu::create($item);
        }
    }
}
