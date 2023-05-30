<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::factory(90)->create()->each(
            function(Product $product){

                Image::factory(4)-> create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });

    }
}
