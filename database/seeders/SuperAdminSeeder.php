<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin001@example.com',
            'password' => Hash::make('Whoareyouadmin'),
            'role_as' => 1,
        ]);
    }
}
