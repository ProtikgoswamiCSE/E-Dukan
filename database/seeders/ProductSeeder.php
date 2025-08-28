<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'name' => 'Smartphone Pro Max',
                'description' => 'Latest smartphone with advanced features and high-quality camera.',
                'price' => 999.99,
                'stock' => 50,
                'category_id' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Premium wireless headphones with noise cancellation.',
                'price' => 299.99,
                'stock' => 30,
                'category_id' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'Laptop Gaming Pro',
                'description' => 'High-performance gaming laptop with dedicated graphics card.',
                'price' => 1599.99,
                'stock' => 15,
                'category_id' => 1,
                'is_visible' => true,
            ],

            // Clothing
            [
                'name' => 'Classic Denim Jacket',
                'description' => 'Stylish denim jacket perfect for casual wear.',
                'price' => 79.99,
                'stock' => 25,
                'category_id' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable 100% cotton t-shirt in various colors.',
                'price' => 24.99,
                'stock' => 100,
                'category_id' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'Running Sneakers',
                'description' => 'Lightweight running sneakers with excellent grip.',
                'price' => 129.99,
                'stock' => 40,
                'category_id' => 2,
                'is_visible' => true,
            ],

            // Books
            [
                'name' => 'Programming Guide 2024',
                'description' => 'Comprehensive guide to modern programming languages.',
                'price' => 49.99,
                'stock' => 75,
                'category_id' => 3,
                'is_visible' => true,
            ],
            [
                'name' => 'Mystery Novel Collection',
                'description' => 'Collection of bestselling mystery novels.',
                'price' => 34.99,
                'stock' => 60,
                'category_id' => 3,
                'is_visible' => true,
            ],

            // Home & Garden
            [
                'name' => 'Smart Home Hub',
                'description' => 'Central hub for controlling all your smart home devices.',
                'price' => 199.99,
                'stock' => 20,
                'category_id' => 4,
                'is_visible' => true,
            ],
            [
                'name' => 'Garden Tool Set',
                'description' => 'Complete set of essential gardening tools.',
                'price' => 89.99,
                'stock' => 35,
                'category_id' => 4,
                'is_visible' => true,
            ],

            // Sports
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'High-quality yoga mat with excellent grip and cushioning.',
                'price' => 59.99,
                'stock' => 45,
                'category_id' => 5,
                'is_visible' => true,
            ],
            [
                'name' => 'Basketball Official Size',
                'description' => 'Official size basketball perfect for indoor and outdoor play.',
                'price' => 39.99,
                'stock' => 55,
                'category_id' => 5,
                'is_visible' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
