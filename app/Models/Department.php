<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Relacion uno a muchos
    public function towns(){
        return $this->hasMany(Town::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
