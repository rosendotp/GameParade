<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Town;
use App\Models\Department;
use App\Models\Street;
use App\Models\Invoice;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateInvoice extends Component
{
    public $envio_type = 1;

    public $contact, $phone, $address, $references, $shipping_cost = 0;

    public $departments, $towns = [],$streets =[];

    public $department_id = "", $town_id = "",$street_id="";

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];

    public function mount(){
        $this->departments = Department::all();
    }

    public function updatedEnvioType($value){
        if ($value == 1) {
            $this->resetValidation([
                'department_id', 'town_id','street:id', 'address', 'references'
            ]);
        }
    }
    public function updatedDepartmentId($value){
        $this->towns = Town::where('department_id', $value)->get();

        $this->reset(['town_id', 'street_id']);
    }


    public function updatedTownId($value){

        $town = Town::find($value);

        $this->shipping_cost = $town->cost;
        $this->streets = Street::where('town_id', $value)->get();

        $this->reset('street_id');
    }

    public function create_invoice(){

        $rules = $this->rules;

        if($this->envio_type == 2){
            $rules['department_id'] = 'required';
            $rules['town_id'] = 'required';
            $rules['street_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }

        $this->validate($rules);

        $invoice = new Invoice();

        $invoice->user_id = auth()->user()->id;
        $invoice->contact = $this->contact;
        $invoice->phone = $this->phone;
        $invoice->envio_type = $this->envio_type;
        $invoice->shipping_cost = 0;
        $invoice->total = $this->shipping_cost + Cart::subtotal();
        $invoice->content = Cart::content();

        if ($this->envio_type == 2) {
            $invoice->shipping_cost = $this->shipping_cost;
            
            $invoice->envio = json_encode([
                'department' => Department::find($this->department_id)->name,
                'town' => Town::find($this->town_id)->name,
                'street' => Town::find($this->street_id)->name,
                'address' => $this->address,
                'references' => $this->references
            ]);
        }

        $invoice->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();

        return redirect()->route('invoices.payment', $invoice);
    }


    public function render()
    {
        return view('livewire.create-invoice');
    }
}
