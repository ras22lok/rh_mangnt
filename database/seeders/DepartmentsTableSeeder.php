<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'name' => 'Administração',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Recursos Humanos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
