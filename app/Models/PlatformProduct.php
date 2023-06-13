<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformProduct extends Model
{
    use HasFactory;
    protected $table = "platform_product";
    
public function platform(){
        return $this->belongsTo(Platform::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}