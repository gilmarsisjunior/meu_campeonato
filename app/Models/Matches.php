<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//models e relacionamentos
class Matches extends Model
{
    use HasFactory;

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
