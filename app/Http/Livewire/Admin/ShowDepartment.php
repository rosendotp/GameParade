<?php

namespace App\Http\Livewire\Admin;


use App\Models\Department;
use App\Models\Town;
use Livewire\Component;

class ShowDepartment extends Component
{
    protected $listeners = ['delete'];

    public $department, $towns, $town;

    public $createForm = [
        'name' => '',
        'cost' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'cost' => null
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.cost' => 'costo'
    ];


    public function mount(Department $department){
        $this->department = $department;
        $this->getTowns();
    }

    public function getTowns(){
        $this->towns = Town::where('department_id', $this->department->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            "createForm.cost" => 'required|numeric|min:1|max:100',
        ]);

        $this->department->towns()->create($this->createForm);


        $this->reset('createForm');

        $this->getTowns();

        $this->emit('saved');
    }

    public function edit(Town $town){
        $this->town = $town;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $town->name;
        $this->editForm['cost'] = $town->cost;
    }

    public function update(){
        $this->town->name = $this->editForm['name'];
        $this->town->cost = $this->editForm['cost'];
        $this->town->save();

        $this->reset('editForm');
        $this->getTowns();
    }


    public function delete(Town $town){
        $town->delete();
        $this->getTowns();
    }


    public function render()
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
