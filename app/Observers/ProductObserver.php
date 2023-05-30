<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    public function updated(Product $product){
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if ($subcategory->edition) {

            if ($product->platforms->count()) {
                $product->platforms()->detach();
            }
            
        }elseif ($subcategory->platform) {
            if ($product->editions->count()) {
                foreach ($product->editions as $edition) {
                    $edition->delete();
                }
            }
        }else{
            if ($product->platforms->count()) {
                $product->platforms()->detach();
            }

            if ($product->editions->count()) {
                foreach ($product->editions as $edition) {
                    $edition->delete();
                }
            }
        }
    }
}