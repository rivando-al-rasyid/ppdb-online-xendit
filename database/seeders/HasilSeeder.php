<?php

namespace Database\Seeders;

use App\Models\TblHasil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            // Add more sample data as needed
        ];

        // Insert the data
        foreach ($data as $item) {
            TblHasil::create($item);
        }
    }
}
