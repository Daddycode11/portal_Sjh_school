<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PrincipalAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Check if principal already exists
        $principal = User::where('user_role', 'principal')->first();

        if (!$principal) {
            User::create([
                'name' => 'Principal Account',
                'student_number' => 'PRINCIPAL001',
                'major' => 'N/A',
                'sex' => 'M', // ✅ changed to match ENUM ['F','M']
                'course' => 'N/A',
                'year' => 'N/A',
                'user_role' => 'principal',
                'password' => Hash::make('principal123'), // ✅ hashed password
            ]);

            $this->command->info('✅ Principal account created successfully!');
        } else {
            $this->command->info('ℹ️ Principal account already exists. Skipped.');
        }
    }
}
