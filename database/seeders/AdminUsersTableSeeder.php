<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('admin_users')->insert([
        'email' => 'nagoyameshiadmin@example.com',
        'password' => Hash::make('nagoya2025'), // 必ずハッシュ化
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }
}
