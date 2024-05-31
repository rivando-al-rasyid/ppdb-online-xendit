<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import the Str class

class TuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Ahmad Setiawan',
                'nip' => 1234567891011121,
                'email' => 'ahmad.setiawan@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aisyah',
                'nip' => 1234567891011122,
                'email' => 'siti.aisyah@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'nip' => 1234567891011123,
                'email' => 'budi.santoso@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Lestari',
                'nip' => 1234567891011124,
                'email' => 'dewi.lestari@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agus Supriyadi',
                'nip' => 1234567891011125,
                'email' => 'agus.supriyadi@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Putri Ayu',
                'nip' => 1234567891011126,
                'email' => 'putri.ayu@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rizki Pratama',
                'nip' => 1234567891011127,
                'email' => 'rizki.pratama@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lina Marlina',
                'nip' => 1234567891011128,
                'email' => 'lina.marlina@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga Firmansyah',
                'nip' => 1234567891011129,
                'email' => 'yoga.firmansyah@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Susanti',
                'nip' => 1234567891011130,
                'email' => 'rina.susanti@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // Hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the data
        DB::table('tus')->insert($data);
    }
}
