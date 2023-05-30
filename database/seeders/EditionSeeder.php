<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class EditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::whereHas('subcategory',function(Builder $query){
            $query->where('platform',true)->where('edition',true);
        })->get();
        
        $editions=['estandar','coleccionista','digital'];

        foreach ($products as $product){
            foreach($editions as $edition){
                $product->editions()->create([
                'name'=> $edition
                ]);
            }
        }
    }
}
