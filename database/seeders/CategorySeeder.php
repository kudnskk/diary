<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Travel'],
            ['name' => 'Food'],
            ['name' => 'Personal'],
            ['name' => 'Technology'],
            ['name' => 'Work'],
            ['name' => 'School'],
            ['name' => 'Sport'],
            ['name' => 'Events']
            
        ];

        
        DB::table('categories')->insert($categories);
    }
}
