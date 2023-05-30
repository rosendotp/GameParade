<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Town;
use App\Models\Street;

class TownComponent extends Component
{
    protected $listeners = ['delete'];

    public $town, $streets, $street;

    public $createForm = [
        'name' => '',
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
    ];

    public function mount(Town $town){
        $this->town = $town;
        $this->getStreets();
    }

    public function getStreets(){
        $this->streets = Street::where('town_id', $this->town->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
        ]);

        $this->town->streets()->create($this->createForm);

        $this->reset('createForm');

        $this->getStreets();

        $this->emit('saved');
    }

    public function edit(Street $street){
        $this->street = $street;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $street->name;
    }

    public function update(){
        $this->street->name = $this->editForm['name'];
        $this->street->save();

        $this->reset('editForm');
        $this->getStreets();
    }

    public function delete(Street $street){
        $street->delete();
        $this->getStreets();
    }


    public function render()
    {
        return view('livewire.admin.town-component')->layout('layouts.admin');
    }
}
