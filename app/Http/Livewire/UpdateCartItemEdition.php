<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\Platform;
use App\Models\Edition;

class UpdateCartItemEdition extends Component
{
    public $rowId, $qty, $quantity;

    public function mount(){
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;

        $platform = Platform::where('name', $item->options->platform)->first();
        $edition = Edition::where('name', $item->options->edition)->first();

        $this->quantity = qty_available($item->id, $platform->id, $edition->id);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;

        Cart::update($this->rowId, $this->qty);

        $this->emit('render');
    }

    public function increment(){
        $this->qty = $this->qty + 1;

        Cart::update($this->rowId, $this->qty);

        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.update-cart-item-edition');
    }
}
