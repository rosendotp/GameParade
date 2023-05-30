<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemPlatform extends Component
{
    public $product, $platforms; 
    public $platform_id = "";

    public $qty = 1;
    public $quantity = 0;

    public $options = [
        'edition_id' => null
    ];
    public function mount(){
        $this->platforms = $this->product->platforms;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedPlatformId($value){
        $platform = $this->product->platforms->find($value);
        $this->quantity = qty_available($this->product->id, $platform->id);
        $this->options['platform'] = $platform->name;
        $this->options['platform_id'] = $platform->id;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        
        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'qty' => $this->qty, 
                    'price' => $this->product->price, 
                    'weight' => 550,
                    'options' => $this->options
                ]);

        $this->quantity = qty_available($this->product->id, $this->platform_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }
    public function render()
    {
        return view('livewire.add-cart-item-platform');
    }
}
