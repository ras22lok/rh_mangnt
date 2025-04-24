<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_details')->insert([
            'user_id' => 1,
            'address' => 'Rua do Administrador, 123',
            'zip_code' => '1234-123',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => 8000.00,
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
