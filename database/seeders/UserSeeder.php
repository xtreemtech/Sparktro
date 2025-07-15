<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => strtolower('sparktroadmin@yopmail.com')],
            [
                'name' => 'SPARTTO ADMIN',
                'password' => bcrypt('Test@1234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'is_admin' => true,
                'is_active' => true,
            ]
        );
    }
}
