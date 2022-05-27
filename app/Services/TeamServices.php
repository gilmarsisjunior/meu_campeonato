<?php
namespace App\Services;


class TeamServices {


    public function shuffleTeams($request){

        $teams []= $request->name1;
        $teams []= $request->name2;
        $teams []= $request->name3;
        $teams []= $request->name4;
        $teams []= $request->name5;
        $teams []= $request->name6;
        $teams []= $request->name7;
        $teams []= $request->name8;
        shuffle($teams);

        $teams_a = [];
        
        $team_A_Indexes = array_rand($teams, 4);

        foreach($team_A_Indexes as $team){
            array_push($teams_a, $teams[$team]);
            unset($teams[$team]);
        }
        $teams_b = $teams;
        
        $dispute_a = $this->makeDisputeQF($teams_a);
        $dispute_b = $this->makeDisputeQF($teams_a);
        $table = [
            "grupo_a"=> $dispute_a,
            "grupo_b"=> $dispute_b
        ];  

        return $table;

    }


    public function makeDisputeQF(array $teams){
        $dispute1 = [];
        $dispute2 = [];
        $dp1 = array_rand($teams, 2);
            foreach($dp1 as $dispute){

                array_push($dispute1, $teams[$dispute]);
                unset($teams[$dispute]);
            };
        $dispute2 = $teams;
        $confront = [
            array_values($dispute1),
            array_values($dispute2),
        ];
        
        return $confront;
    }
    
    public function getGoals(){
        $cmd = shell_exec("C:/Users/gilmar.santos/AppData/Local/Programs/Python/Python39/python.exe scripts.py 2>&1");
        $goals = preg_replace( "/<br>|\n/", "|", $cmd);
        $goals = rtrim($goals, '|');
        $goals = explode('|', $goals);
       return $this->tie($goals);
    }
  public function getPoints($goals, $taken){
      return ($goals-$taken);
  }

  public function tie($goals){

      if($goals[0] === $goals[1]){
        $goals[0]= $goals[0]++;
      }
      return $goals;
  }
}


?>