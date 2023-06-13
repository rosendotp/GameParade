<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Consolas y Accesorios',
                'slug' => Str::slug('consolas'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Videojuegos',
                'slug' => Str::slug('Videojuegos'),
                'icon' => '<i class="fa-brands fa-space-awesome"></i>'
            ],
            [
                'name' => 'Merchandising',
                'slug' => Str::slug('Merchandising'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        foreach ($categories as $category) {
            $category = Category::factory(1)->create($category)->first();

            $brands = Brand::factory(4)->create();

            foreach ($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
