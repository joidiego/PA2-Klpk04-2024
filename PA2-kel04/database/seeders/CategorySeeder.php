<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'name' => 'Bingkai',
            'slug' => 'Bingkai',
            'parent_id' => null
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Labu Lampu',
            'slug' => 'Labu Lampu',
            'parent_id' => 1
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Mainan',
            'slug' => 'Mainan',
            'parent_id' => 1
        ]);
    }
}
