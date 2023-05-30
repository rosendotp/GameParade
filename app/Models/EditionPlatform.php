<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditionPlatform extends Model
{
    use HasFactory;
    protected $table = "edition_platform";


    public function platform(){
        return $this->belongsTo(Platform::class);
    }
    public function edition(){
        return $this->belongsTo(Edition::class);
    }
}
