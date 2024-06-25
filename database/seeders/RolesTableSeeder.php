<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Administrator role with full access.'
        ]);

        Role::create([
            'name' => 'user',
            'description' => 'Regular user role with basic access.'
        ]);

        // Add more roles as needed
    }
}

