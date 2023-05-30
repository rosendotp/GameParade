<?php

use App\Models\Product;
use App\Models\Edition;
use App\Models\Platform;
use Gloudemans\Shoppingcart\Facades\Cart;


function quantity($product_id, $platform_id = null, $edition_id = null){
    $product = Product::find($product_id);

    if($edition_id){
        $edition = Edition::find($edition_id);
        $quantity = $edition->platforms->find($platform_id)->pivot->quantity;
    }elseif($platform_id){
        $quantity = $product->platforms->find($platform_id)->pivot->quantity;
    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

function qty_added($product_id, $platform_id = null, $edition_id = null){

    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.platform_id', $platform_id)
                ->where('options.edition_id', $edition_id)
                ->first();

    if($item){
        return $item->qty;
    }else{
        return 0;
    }

}

function qty_available($product_id, $platform_id = null, $edition_id = null){

    return quantity($product_id, $platform_id, $edition_id) - qty_added($product_id, $platform_id, $edition_id);

}


function discount($item){
    $product = Product::find($item->id);
    $qty_available = qty_available($item->id, $item->options->platform_id, $item->options->edition_id);


    if ($item->options->edition_id) {
        
        $edition = Platform::find($item->options->edition_id);

        $edition->platforms()->detach($item->options->platform_id);

        $edition->platforms()->attach([
            $item->options->platform_id => ['quantity' => $qty_available]
        ]);

    }elseif($item->options->platform_id){

        $product->platforms()->detach($item->options->platform_id);

        $product->platforms()->attach([
            $item->options->platform_id => ['quantity' => $qty_available]
        ]);


    }else{


        $product->quantity = $qty_available;
        $product->save();

    }

}

function increase($item){

    $product = Product::find($item->id);
    
    $quantity = quantity($item->id, $item->options->platform_id, $item->options->edition_id) + $item->qty;


    if ($item->options->edition_id) {
        
        $edition = Edition::find($item->options->edition_id);

        $edition->platforms()->detach($item->options->platform_id);

        $edition->platforms()->attach([
            $item->options->platform_id => ['quantity' => $quantity]
        ]);

    }elseif($item->options->platform_id){

        $product->platforms()->detach($item->options->platform_id);

        $product->platforms()->attach([
            $item->options->platform_id => ['quantity' => $quantity]
        ]);


    }else{


        $product->quantity = $quantity;
        $product->save();

    }

}