<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use App\Observers\ProductObserver;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
   public function review(User $user,Product $product){
    $invoices= Invoice::where('user_id',1)->select('content')->get()->map(function($invoice){
        return json_decode($invoice->content,true);
    });

    $product = $invoices->collapse();
    }
}
