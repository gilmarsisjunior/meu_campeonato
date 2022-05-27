<?php
namespace App\Repository;
use App\Models;
use App\Models\Points;
use App\Models\Match;
use App\Models\Team;
use App\Services\TeamServices;
use App\Repository\PointRepository;
use Illuminate\Support\Facades\DB;


class MatchRepository {


    public function insert($match){
        DB::table('matches')->insert($match);
    }

    public function semiFinals(){
        $PointsRepository = new Points;
        $semi_finalA = Points::orderBy('points','DESC')->where('key', 'A')->limit(2)->get()->toArray();
        $semi_finalB = Points::orderBy('points','DESC')->where('key', 'B')->limit(2)->get()->toArray();
        $confronto = array_merge($semi_finalA, $semi_finalB);
        $sort = new TeamServices();
        $pts = [];
        $group = Team::find($semi_finalA[0]["id_team"]);
        $group = $group['group'];

            $goals = $sort->getGoals();
            $match_a = [];
            
            array_push($match_a, [
                "id_team1"=> $confronto[0]["id_team"],
                "goals_team1"=>$goals[0],
                "taken_team1" =>$goals[1],
                "points_team1"=>$goals[0]-$goals[1],
                "id_team2"=> $confronto[1]["id_team"],
                "goals_team2"=>$goals[1],
                "taken_team2" =>$goals[0],
                "points_team2"=> $goals[1]-$goals[0],
                "group"=> $group,
                "match"=>'SF'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[0]["id_team"],
                "points"=>$goals[0]-$goals[1],
                "key"=> 'A',
                "match"=>'SF'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[1]["id_team"],
                "points"=>$goals[1]-$goals[0],
                "key"=> 'A',
                "match"=>'SF'
            ]);

            $goals = $sort->getGoals();
            array_push($match_a, [
                "id_team1"=> $confronto[2]["id_team"],
                "goals_team1"=>$goals[0],
                "taken_team1" =>$goals[1],
                "points_team1"=>$goals[0]-$goals[1],
                "id_team2"=> $confronto[3]["id_team"],
                "goals_team2"=>$goals[1],
                "taken_team2" =>$goals[0],
                "points_team2"=>$goals[1]-$goals[0],
                "group"=> $group,
                "match"=>'SF'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[2]["id_team"],
                "points"=>$goals[0]-$goals[1],
                "key"=> 'B',
                "match"=>'SF'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[3]["id_team"],
                "points"=>$goals[1]-$goals[0],
                "key"=> 'B',
                "match"=>'SF'
            ]);
            $this->insert($match_a);
            $PointsRepository->insert($pts);

    }
    public function finals(){
        $confronto = Points::orderBy('points', 'desc')->where('match', 'SF')->limit(2)->get()->toArray();
        $group = Team::find($confronto[0]["id_team"]);
        $group = $group['group'];
        $sort = new TeamServices();
        $PointsRepository = new Points;
            $goals = $sort->getGoals();
            $match_a = [];
            $pts = [];
            array_push($match_a, [
                "id_team1"=> $confronto[0]["id_team"],
                "goals_team1"=>$goals[0],
                "taken_team1" =>$goals[1],
                "points_team1"=>$goals[0]-$goals[1],
                "id_team2"=> $confronto[1]["id_team"],
                "goals_team2"=>$goals[1],
                "taken_team2" =>$goals[0],
                "points_team2"=> $goals[1]-$goals[0],
                "group"=> $group,
                "match"=>'FN'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[0]["id_team"],
                "points"=>$goals[0]-$goals[1],
                "key"=> $confronto[0]["key"],
                "match"=>'FN'
            ]);
            array_push($pts, [
                "id_team"=>$confronto[1]["id_team"],
                "points"=>$goals[1]-$goals[0],
                "key"=> $confronto[1]["key"],
                "match"=>'FN'
            ]);
        $this->insert($match_a);
        $PointsRepository->insert($pts);
    }
    
    public function winner(){
        $winner = Points::orderBy('points', 'desc')->where('match', 'FN')->get();
        return $winner;
    }
    public function getAll(){
        
        return Team::orderBy('name', 'asc')->get();
    }
}


?>
