<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;


    public function point(){
        return $this->hasOne(Points::class, 'id_team');
    }
    public function matches(){
        return $this->hasOne(Matches::class, 'id_team1');
    }
}
