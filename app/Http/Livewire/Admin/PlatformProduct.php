<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform;
use App\Models\PlatformProduct as Pivot;
use Livewire\Component;

class PlatformProduct extends Component
{
    public $product, $platforms, $platform_id, $quantity, $open = false;

    public $pivot, $pivot_platform_id, $pivot_quantity;

    protected $listeners = ['delete'];

    protected $rules = [
        'platform_id' => 'required',
        'quantity' => 'required|numeric'
    ];


    public function mount(){
        $this->platforms = Platform::all();
    }

    public function save(){
        $this->validate();

        $pivot = Pivot::where('platform_id', $this->platform_id)
                    ->where('product_id', $this->product->id)
                    ->first();

        if ($pivot) {

            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();

        } else {
            
            $this->product->platforms()->attach([
                $this->platform_id => [
                    'quantity' => $this->quantity
                ]
            ]);
            
        }

        $this->reset(['platform_id', 'quantity']);

        $this->emit('saved');

        $this->product = $this->product->fresh();

    }


    public function edit(Pivot $pivot){
        $this->open = true;

        $this->pivot = $pivot;
        $this->pivot_platform_id = $pivot->platform_id;
        $this->pivot_quantity = $pivot->quantity;
    }


    public function update(){
        $this->pivot->platform_id = $this->pivot_platform_id;
        $this->pivot->quantity = $this->pivot_quantity;

        $this->pivot->save();

        $this->product = $this->product->fresh();

        $this->open = false;
    }

    public function delete(Pivot $pivot){
        $pivot->delete();
        $this->product = $this->product->fresh();
    }
    public function render()
    {
        $product_platforms = $this->product->platforms;
        
        return view('livewire.admin.platform-product', ['product_platforms'=>$product_platforms]);
    }
}
