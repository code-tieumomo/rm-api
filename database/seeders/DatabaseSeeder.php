<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Account::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Admin',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Brooklynn',
            'role' => 1,
        ]);

        Account::create([
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Manager',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Jessica',
            'role' => 2,
        ]);

        Account::create([
            'email' => 'waiter@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Waiter',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Jocelyn',
            'role' => 3,
        ]);
    }
}
