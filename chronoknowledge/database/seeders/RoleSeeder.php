<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Admin',
                'display_name' => 'Admin account',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'User',
                'display_name' => 'User account',
                'created_at' => now(),
            ],
        ]);
    }
}
