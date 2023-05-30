<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class PlatformProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereHas('subcategory',function(Builder $query){
            $query->where('platform',true)->where('edition',false);
        })->get();
        foreach($products as $product){
            $product->platforms()->attach([
                1=> ['quantity' => 10],
            2=> ['quantity' => 10],
            3=> ['quantity' => 10],
            4=> ['quantity' => 10]
        ]);
        }
    }
}
