<?php

namespace App\Models;

use App\Models\EditionPlatform;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const DELETED= 1;
    const PUBLISHED=0;

    protected $guarded = ['id','created_at','update_at'];

    public function getStockAttribute(){
        if ($this->subcategory->edition) {
            return  EditionPlatform::whereHas('edition.product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        } elseif($this->subcategory->platform) {
            return  PlatformProduct::whereHas('product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        }else{

            return $this->quantity;

        }
        
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function platforms(){
        return $this->belongsToMany(Platform::class)->withPivot('quantity', 'id');
    }
    public function editions(){
        return $this->hasMany(Edition::class);
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
        //URL AMIGABLES
    public function getRouteKeyName()
        {
            return 'slug';
        }
}