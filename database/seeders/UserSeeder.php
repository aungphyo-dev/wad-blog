<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name"=>'Aung Pyae Phyo',
            "email" => "app@gmail.com",
            'password' => Hash::make('asdffdsa'), // password
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);
        User::factory(10)->create();
    }
}
