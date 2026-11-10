<?php

namespace Database\Seeders;

use App\Features\Auth\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Default Admin',
                'password' => Hash::make('password'),
            ],
        );
    }
}
