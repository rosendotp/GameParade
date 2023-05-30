<?php

namespace App\Http\Livewire;
use App\Models\Invoice;
use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentInvoice extends Component
{
    use AuthorizesRequests;

    public $invoice;

    protected $listeners = ['payInvoice'];

    public function mount(Invoice $invoice){
        $this->invoice = $invoice;
    }


    public function payInvoice(){
        $this->invoice->status = 2;
        $this->invoice->save();

        return redirect()->route('invoices.show', $this->invoice);
    }

    public function render()
    {
        $this->authorize('author', $this->invoice);
        $this->authorize('payment', $this->invoice);

        $items = json_decode($this->invoice->content);
        $envio = json_decode($this->invoice->envio);

        $data = [
            'items' => $items,
            'envio' => $envio
        ];
        
        return view('livewire.payment-invoice', $data);
    }
}
