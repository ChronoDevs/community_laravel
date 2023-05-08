<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'category_id' => 1,
                'title' => Str::random(20),
                'plain_description' => Str::random(100),
                'html_description' => Str::random(100),
                'status' => 1,
                'created_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'category_id' => 1,
                'title' => Str::random(20),
                'plain_description' => Str::random(100),
                'html_description' => Str::random(100),
                'status' => 1,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'category_id' => 1,
                'title' => Str::random(20),
                'plain_description' => Str::random(100),
                'html_description' => Str::random(100),
                'status' => 1,
                'created_at' => now()
            ],
        ]);
    }
}
