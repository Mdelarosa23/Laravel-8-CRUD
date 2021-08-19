<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'System Admin',
                'description' => 'Sample Admin Description'
            ],
            [
                'role_name' => 'Staff',
                'description' => 'Sample Staff Description'
            ],
        ]);
    }
}
