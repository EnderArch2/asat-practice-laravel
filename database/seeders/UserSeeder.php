<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => 'password',
                'roles' => 'admin'
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@mail.com',
                'password' => 'password',
                'roles' => 'user'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'roles' => $user['roles'],
            ]);
        }
    }
}
