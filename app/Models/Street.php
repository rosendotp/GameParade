<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'town_id'];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
