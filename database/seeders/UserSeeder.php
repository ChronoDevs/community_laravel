<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use App\Enums\UserGender;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'role_id' => UserRole::USER,
                'email' => 'testuser@gmail.com',
                'username' => 'testuser',
                'password' => Hash::make('password'),
                'name' => 'Test User',
                'nick_name' => 'tu',
                'birth_date' => '2001-02-01',
                'gender' => UserGender::MALE,
                'zip_code' => Str::random(8),
                'address' => Str::random(100),
                'tel' => Str::random(11),
                'job_title' => 'Software Engineer'
            ],
            [
                'id' => 2,
                'role_id' => UserRole::ADMIN,
                'email' => 'testadmin@gmail.com',
                'username' => 'testadmin',
                'password' => Hash::make('password'),
                'name' => 'Test Admin',
                'nick_name' => 'ta',
                'birth_date' => '2001-02-01',
                'gender' => UserGender::MALE,
                'zip_code' => Str::random(8),
                'address' => Str::random(100),
                'tel' => Str::random(11),
                'job_title' => 'Software Engineer'
            ]
        ]);
    }
}
