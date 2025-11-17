<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Admin user
        User::updateOrCreate(
            ['student_number' => 'administrator'],
            [
                'name' => 'Admin',
                'major' => 'admin',
                'sex' => 'F',
                'course' => 'admin',
                'year' => 'admin',
                'password' => Hash::make('Admin@123'),
                'user_role' => 'admin',
            ]
        );

        // ✅ Sample clients
        $clients = [
            ['name' => 'Santos, Juan Miguel', 'student_number' => '15-SC-2264', 'sex' => 'M'],
            ['name' => 'Reyes, Maria Clara Dela Cruz', 'student_number' => '15-SC-2121', 'sex' => 'F'],
            ['name' => 'Garcia, Luis Antonio', 'student_number' => '15-SC-2145', 'sex' => 'M'],
            ['name' => 'Lopez, Ana Teresa', 'student_number' => '15-SC-2198', 'sex' => 'F'],
            ['name' => 'Cruz, Miguel Angelo', 'student_number' => '15-SC-2230', 'sex' => 'M'],
            ['name' => 'Torres, Kristine Joy', 'student_number' => '15-SC-2177', 'sex' => 'F'],
            ['name' => 'Dela Rosa, Mark Anthony', 'student_number' => '15-SC-2255', 'sex' => 'M'],
            ['name' => 'Flores, Janine Marie', 'student_number' => '15-SC-2180', 'sex' => 'F'],
            ['name' => 'Valdez, Rafael', 'student_number' => '15-SC-2201', 'sex' => 'M'],
            ['name' => 'Santos, Katrina Mae', 'student_number' => '15-SC-2210', 'sex' => 'F'],
        ];

        foreach ($clients as $client) {
            User::updateOrCreate(
                ['student_number' => $client['student_number']],
                [
                    'name' => $client['name'],
                    'major' => 'SC_BSIT',
                    'course' => 'CHMBAC',
                    'year' => 'THIRD YEAR',
                    'sex' => $client['sex'],
                    'password' => Hash::make('Client@123'),
                    'user_role' => 'client',
                ]
            );
        }
    }
}
