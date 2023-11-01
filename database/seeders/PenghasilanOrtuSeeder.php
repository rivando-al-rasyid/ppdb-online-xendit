<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenghasilanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lowerLimit = 500000; // Starting value
        $upperLimit = 5000000; // Maximum value

        for ($i = $lowerLimit; $i <= $upperLimit; $i += 500000) {
            DB::table('tbl_penghasilan_ortu')->insert([
                'penghasilan_ortu' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
