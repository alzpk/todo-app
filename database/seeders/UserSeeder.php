<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.dk',
            'name' => 'Admin Adminson',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
        ]);
    }
}
