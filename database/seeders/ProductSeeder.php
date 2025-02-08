<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            Product::create([
                'name' => 'Producto de ' . $category->name,
                'price' => rand(10, 1000),
                'stock' => rand(0, 100),
                'active' => rand(0, 1),
                'category_id' => $category->id
            ]);
        }
    }
}
