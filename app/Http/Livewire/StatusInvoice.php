<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusInvoice extends Component
{
    public $invoice, $status;

    public function mount(){
        $this->status = $this->invoice->status;
    }

    public function update(){
        $this->invoice->status = $this->status;
        $this->invoice->save();
    }

    public function render()
    {

        $items = json_decode($this->invoice->content);
        $envio = json_decode($this->invoice->envio);

        $data = [
            'items' => $items,
            'envio' => $envio
        ];
        
        return view('livewire.status-invoice', $data);
    }

}
