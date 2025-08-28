<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
                'is_visible' => true,
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion and apparel',
                'is_visible' => true,
            ],
            [
                'name' => 'Books',
                'description' => 'Books and literature',
                'is_visible' => true,
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home improvement and gardening',
                'is_visible' => true,
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports and outdoor activities',
                'is_visible' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
