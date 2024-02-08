<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import the Str class


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User',
            'surname' => 'name',
            'jenkel' => 'L',
            'email' => 'asura@example.com',
            'no_hp' => '081365669975',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // Hash the password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
