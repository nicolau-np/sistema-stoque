<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    static $users = [
        [
            'name' => "Martinha",
            'username' => "martinha.constantino",
            'nivel_acesso' => "admin",
            'password' => "stoque2024",
        ], [
            'name' => "Alfredo",
            'username' => "user.alfredo",
            'nivel_acesso' => "user",
            'password' => "transporte001",
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Self::$users as $user) {
            User::create($user);
        }
    }
}
