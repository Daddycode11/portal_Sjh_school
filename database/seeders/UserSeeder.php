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
                'gender' => 'F',            // use 'gender' column
                'password' => Hash::make('Admin@123'),
                'user_role' => 'admin',
            ]
        );

        // ✅ Sample clients
        $clients = [
            ['name' => 'Santos, Juan Miguel', 'student_number' => '15-SC-2264', 'gender' => 'M'],
            ['name' => 'Reyes, Maria Clara Dela Cruz', 'student_number' => '15-SC-2121', 'gender' => 'F'],
            ['name' => 'Garcia, Luis Antonio', 'student_number' => '15-SC-2145', 'gender' => 'M'],
            ['name' => 'Lopez, Ana Teresa', 'student_number' => '15-SC-2198', 'gender' => 'F'],
            ['name' => 'Cruz, Miguel Angelo', 'student_number' => '15-SC-2230', 'gender' => 'M'],
            ['name' => 'Torres, Kristine Joy', 'student_number' => '15-SC-2177', 'gender' => 'F'],
            ['name' => 'Dela Rosa, Mark Anthony', 'student_number' => '15-SC-2255', 'gender' => 'M'],
            ['name' => 'Flores, Janine Marie', 'student_number' => '15-SC-2180', 'gender' => 'F'],
            ['name' => 'Valdez, Rafael', 'student_number' => '15-SC-2201', 'gender' => 'M'],
            ['name' => 'Santos, Katrina Mae', 'student_number' => '15-SC-2210', 'gender' => 'F'],
        ];

        foreach ($clients as $client) {
            User::updateOrCreate(
                ['student_number' => $client['student_number']],
                [
                    'name' => $client['name'],
                    'gender' => $client['gender'],
                    'password' => Hash::make('Client@123'),
                    'user_role' => 'client',
                ]
            );
        }
    }
}
