<?php
namespace App\Repository;
use App\Models;

use App\Models\Points;

use Illuminate\Support\Facades\DB;


//esse repositories é responsável por inserir dados na tabela de pontos
class PointRepository {



    public function insert($points){
        DB::table("points")->insert($points);
    }

}



?>