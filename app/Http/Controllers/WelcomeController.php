<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Invoice;

class WelcomeController extends Controller
{
    //
    public function __invoke()
    {
    
            if (auth()->user()) {
    
                $pendiente = Invoice::where('status', 1)->where('user_id', auth()->user()->id)->count();
    
                if ($pendiente) {
    
                    $mensaje = "Usted tiene $pendiente facturas pendientes. <a class='font-bold' href='" . route('invoices.index') ."?status=1'>Ir a pagar</a>";
    
                    session()->flash('flash.banner', $mensaje);
                }
    
            }
    
        $categories = Category::all();

        return view('welcome',['categories' => $categories]);
    }
}
