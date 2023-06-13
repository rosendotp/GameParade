<?php

namespace App\Http\Livewire\Admin;

use App\Models\Edition;
use Livewire\Component;

class EditionProduct extends Component
{
    public $product, $name, $open = false;

    public $edition, $name_edit;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required'
    ];

    public function save(){
        $this->validate();

        $edition = Edition::where('product_id', $this->product->id)
                    ->where('name', $this->name)
                    ->first();

        if ($edition) {

            $this->emit('errorEdition', 'Esa edicion ya existe');
            
        } else {

            $this->product->editions()->create([
                'name' => $this->name
            ]);

        }

        $this->reset('name');

        $this->product = $this->product->fresh();
    }


    public function edit(Edition $edition){
        $this->open = true;
        $this->edition = $edition;
        $this->name_edit = $edition->name;
    }

    public function update(){
        $this->validate([
            'name_edit' => 'required'
        ]);

        $this->edition->name = $this->name_edit;
        $this->edition->save();

        $this->product = $this->product->fresh();

        $this->open = false;
    }

    public function delete(Edition $edition){
        $edition->delete();
        $this->product = $this->product->fresh();
    }
    public function render()
    {
        $editions = $this->product->editions;

        
        return view('livewire.admin.edition-product',['editions'=>$editions]);
    }
}
