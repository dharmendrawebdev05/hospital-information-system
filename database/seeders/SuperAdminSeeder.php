<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SuperAdminSeeder extends Seeder
{
public function run(): void
{
User::updateOrCreate(
['email' => 'sofynexglobal@gmail.com'],
[
'name' => 'Super Admin',
'password' => Hash::make('sofynexglobal'),
'email_verified_at' => now(),

// Agar users table me role/type column hai to:
'role' => 'superadmin',
// ya
// 'user_type' => 'superadmin',

'status' => 1,
]
);
}
}