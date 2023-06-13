<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subcategories = [
            [
            'category_id' => 1,
            'name' => 'Consolas',
            'slug' => Str::slug('Consolas')
            ],
            [
                'category_id' => 1,
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios')
            ],
            [
                'category_id' => 2,
                'name' => 'Videojuego',
                'slug' => Str::slug('Videojuego'),
                'edition' => true,
                'platform' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'DLCs o Tarjetas',
                'slug' => Str::slug('DLCs o Tarjetas'),
                'edition' => false,
                'platform' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Poster',
                'slug' => Str::slug('poster')
            ],
            [
                'category_id' => 3,
                'name' => 'Figuras',
                'slug' => Str::slug('figuras')
            ],
        ];
        
        foreach ($subcategories as $subcategory) {
            

            Subcategory::create($subcategory);

        }
    }
}
