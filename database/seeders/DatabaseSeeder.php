<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin 1
        User::create([
            'display_name' => 'Super Admin',
            'username' => 'admin1',
            'email' => 'admin1@solms.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_email_locked' => false,
        ]);

        // Admin 2
        User::create([
            'display_name' => 'Second Admin',
            'username' => 'admin2',
            'email' => 'admin2@solms.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_email_locked' => false,
        ]);

        // Demo Student
        User::create([
            'display_name' => 'Student One',
            'username' => 'student1',
            'email' => 'student1@solms.id',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_email_locked' => true,
        ]);
    }
}
