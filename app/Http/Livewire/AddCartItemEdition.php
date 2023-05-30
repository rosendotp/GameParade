<?php

namespace App\Http\Livewire;
use App\Models\Edition;
use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Storage;

class AddCartItemEdition extends Component
{
    public $product, $editions;
    public $platform_id = "";
    public $qty = 1;
    public $quantity = 0;
    public $edition_id = "";

    public $platforms = [];

    public $options = [];

    public function mount()
    {
        $this->editions = $this->product->editions;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedEditionId($value)
    {
        $edition = Edition::find($value);
        $this->platforms = $edition->platforms;
        $this->options['edition'] = $edition->name;
        $this->options['edition_id'] = $edition->id;
    }

    public function updatedPlatformId($value)
    {
        $edition = Edition::find($this->edition_id);
        $platform = $edition->platforms->find($value);
        $this->quantity = qty_available($this->product->id, $platform->id, $edition->id);
        $this->options['platform'] = $platform->name;
        $this->options['platform_id'] = $platform->id;
    }


    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    public function addItem()
    {
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);

        $this->quantity = qty_available($this->product->id, $this->platform_id, $this->edition_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }
    public function render()
    {
        return view('livewire.add-cart-item-edition');
    }
}
