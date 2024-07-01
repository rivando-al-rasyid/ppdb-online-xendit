<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test Use r',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            AdminSeeder::class,
            TuSeeder::class,
            PekerjaanOrtuSeeder::class,
            BiodataOrtuSeeder::class,
            UserSeeder::class,
            PesertaPpdbSeeder::class,
            HasilSeeder::class,
            InformasiSekolahSeeder::class,

        ]);
    }
}
