<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index(){

        $invoices = Invoice::query()->where('status', '<>', 1);

        if (request('status')) {
            $invoices->where('status', request('status'));
        }

        $invoices = $invoices->get();


        $pendiente = Invoice::where('status', 1)->count();
        $recibido = Invoice::where('status', 2)->count();
        $enviado = Invoice::where('status', 3)->count();
        $entregado = Invoice::where('status', 4)->count();
        $anulado = Invoice::where('status', 5)->count();

        $data = [
            'invoices' => $invoices,
            'pendiente' => $pendiente,
            'recibido' => $recibido,
            'enviado' => $enviado,
            'entregado' => $entregado,
            'anulado' => $anulado
        ];
        
        return view('admin.invoices.index', $data);
    }  

    public function show(Invoice $invoice){
        return view('admin.invoices.show', ['invoice' => $invoice]);
    }
}
