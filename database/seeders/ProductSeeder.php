<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Nordic Chair',
            'price' => 50.00,
            'image' => 'front/images/product-1.png',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit.'
        ]);

        \App\Models\Product::create([
            'name' => 'Kruzo Aero Chair',
            'price' => 78.00,
            'image' => 'front/images/product-2.png',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit.'
        ]);

        \App\Models\Product::create([
            'name' => 'Ergonomic Chair',
            'price' => 43.00,
            'image' => 'front/images/product-3.png',
            'description' => 'Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit.'
        ]);
    }
}
