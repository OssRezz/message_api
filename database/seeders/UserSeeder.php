<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'James Osorio FLorez',
                'email' => 'OssRezz.13@gmail.com',
                'email_verified_at'  => now(),
                'password' => bcrypt('1234'),
                'remember_token'     => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ];

        User::insert($users);
        }
}
