<?php
namespace App\Repository;
use App\Models;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class teamRepository {
    
    public function insert(array $teams){
         DB::table('teams')->insert($teams); 
    }

    public function select($group){
       $group_a = DB::table('teams')->where('group', $group)->where('key', 'A')->get();
       $group_b = DB::table('teams')->where('group', $group)->where('key', 'B')->get();
       $groups = [["group_a"=>$group_a, "group_b"=>$group_b]];
       return $groups;
     
    }
    public function store(){
        DB::table('matches')->insert();
    }

 
}




?>