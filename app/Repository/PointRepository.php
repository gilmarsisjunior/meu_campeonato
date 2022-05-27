<?php
namespace App\Repository;
use App\Models;

use App\Models\Points;

use Illuminate\Support\Facades\DB;



class PointRepository {



    public function insert($points){
        DB::table("points")->insert($points);
    }

}



?>