<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){

        $invoices = Invoice::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $invoices->where('status', request('status'));
        }

        $invoices = $invoices->get();


        $pendiente = Invoice::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $recibido = Invoice::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $enviado = Invoice::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Invoice::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Invoice::where('status', 5)->where('user_id', auth()->user()->id)->count();

        $data = [
            'invoices' => $invoices,
            'pendiente' => $pendiente,
            'recibido' => $recibido,
            'enviado' => $enviado,
            'entregado' => $entregado,
            'anulado' => $anulado
        ];
        
        return view('invoices.index', $data);
    }

    public function show(Invoice $invoice){

        $this->authorize('author', $invoice);

        $items = json_decode($invoice->content);
        $envio = json_decode($invoice->envio);

        $data = [
            'invoice' => $invoice,
            'items' => $items,
            'envio' => $envio
        ];
        
        return view('invoices.show', $data);
    }


    public function pay(Invoice $invoice, Request $request){

        $this->authorize('author', $invoice);

        $payment_id = $request->get('payment_id');

        $response = "";

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved'){
            $invoice->status = 2;
            $invoice->save();
        }

        return redirect()->route('invoices.show', $invoice);
    }
}
