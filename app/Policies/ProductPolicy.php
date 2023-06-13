<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function review(User $user,Product $product){

        $reviews = $product->reviews()->where('user_id',$user->id)->count();
    
        if($reviews){
            return false;
        }
    
        $invoices= Invoice::where('user_id',$user->id)->select('content')->get()->map(function($invoice){
            return json_decode($invoice->content,true);
        });
    
        $products = $invoices->collapse();
    
        return $products->contains('id',$product->id);
    
        }
}
