<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Welcome to E-Dukan',
                'description' => 'Discover amazing products at unbeatable prices. Shop from the comfort of your home with fast delivery.',
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Shop Now',
                'button_link' => '/shop/category',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Electronics Sale',
                'description' => 'Up to 50% off on the latest gadgets and electronics. Limited time offer!',
                'image' => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Browse Electronics',
                'button_link' => '/shop/category/1',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Fashion Trends 2025',
                'description' => 'Stay ahead with the latest fashion trends. Premium clothing and accessories for everyone.',
                'image' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Explore Fashion',
                'button_link' => '/shop/category/2',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $sliderData) {
            Slider::create($sliderData);
        }
    }
}
