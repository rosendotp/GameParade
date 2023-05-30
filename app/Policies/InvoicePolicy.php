<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invoice;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function author(User $user, Invoice $invoice){
        if ($invoice->user_id == $user->id) {
            return true;
        }else{
            return false;
        }
    }

    public function payment(User $user, Invoice $invoice){
        if ($invoice->status == 1) {
            return true;
        }else{
            return false;
        }
    }
}
