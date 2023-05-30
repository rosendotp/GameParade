<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = ['name','cost', 'department_id'];


    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function streets(){
        return $this->hasMany(Street::class);
    }
}
