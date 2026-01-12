<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PrincipalAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Check if principal already exists
        $principal = User::where('user_role', 'principal')->first();

        if (!$principal) {
            // Only include columns that exist in the users table
            $userData = [
                'name' => 'Principal Account',
                'student_number' => 'PRINCIPAL001',
                'sex' => 'M',
                'password' => Hash::make('principal123'),
            ];

            if (Schema::hasColumn('users', 'user_role')) {
                $userData['user_role'] = 'principal';
            }

            User::create($userData);

            $this->command->info('✅ Principal account created successfully!');
        } else {
            $this->command->info('ℹ️ Principal account already exists. Skipped.');
        }
    }
}
