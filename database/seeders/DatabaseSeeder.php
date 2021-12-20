<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id_web' => Str::uuid(),
            'name_web' => Str::random(10),
            'description' => Str::random(30),
            'logo' => 'logo.png',
        ]);

        DB::table('users')->insert([
            'id_user' => Str::uuid(),
            'role' => 1,
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'profile' => 'default.png',
            'is_active' => '1'
        ]);
    }
}
