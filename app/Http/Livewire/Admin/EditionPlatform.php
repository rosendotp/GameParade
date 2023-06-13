<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Platform;

use App\Models\EditionPlatform as Pivot;


class EditionPlatform extends Component
{
    public $edition, $platforms, $platform_id, $quantity, $open = false;

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
                    ->where('edition_id', $this->edition->id)
                    ->first();

        if ($pivot) {

            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();
            
        }else{

            $this->edition->platforms()->attach([
                $this->platform_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }

        $this->reset(['platform_id', 'quantity']);

        $this->emit('saved');

        $this->edition = $this->edition->fresh();
    }

    public function edit(Pivot $pivot){

        $this->open = true;

        $this->pivot = $pivot;
        $this->pivot_platform_id = $pivot->platform_id;
        $this->pivot_quantity = $pivot->quantity;
    }

    public function update(){

        $this->validate([
            'pivot_platform_id' => 'required',
            'pivot_quantity' => 'required',
        ]);

        $this->pivot->platform_id = $this->pivot_platform_id;
        $this->pivot->quantity = $this->pivot_quantity;

        $this->pivot->save();

        $this->edition = $this->edition->fresh();

        $this->reset('open');
    }

    public function delete(Pivot $pivot){
        $pivot->delete();
        $this->edition = $this->edition->fresh();
    }

    public function render()
    {

        $edition_platforms = $this->edition->platforms;

        return view('livewire.admin.edition-platform',['edition_platforms'=>$edition_platforms]);
    }

}
