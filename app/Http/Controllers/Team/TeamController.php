<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TeamServices;
use Illuminate\Support\Facades\DB;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\PointRepository;
use App\Models\Points;
use App\Models\Team;
use App\Models\Matches;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('main.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Responsável por chamar os repositories que são responsáveis por tratar a lógica e devolver para os controllers;
    //Deveria ter mantido toda lógica que trata os dados dos models direto nos models e desenvolver voltado para interface

    public function create(Request $request, TeamRepository $TeamRepository, MatchRepository $MatchRepository, PointRepository $PointsRepository)
    {  

        
        $teams = [];
        $sort = new TeamServices();
        $goals = $sort->getGoals();

        $results = $sort->shuffleTeams($request);
        $all_teams = $request->all();
        array_shift($all_teams);
        $group = array_pop($all_teams);
        $count = 0;
        shuffle($all_teams);
        foreach($all_teams as $k=>$team){
            $count ++;
            $key = 'A';
            if($count >4) $key = 'B';
            array_push($teams,
            ["name"=>$team,
             "key"=> $key,
             "group"=>$group,
        ]);
        }
        
        $TeamRepository->insert($teams);
        $times = $TeamRepository->select($group);
        $time_a = $sort->makeDisputeQF($times[0]['group_a']->toArray());
        $time_b = $sort->makeDisputeQF($times[0]['group_b']->toArray());
        $teams_array =  array_merge($time_a, $time_b);
        $match_a = [];
        $pts = [];
        foreach($teams_array as $key => $match){

            $goals1 = $sort->getGoals()[0];
            $goals2 = $sort->getGoals()[1];
            $points[] = $sort->getPoints($goals1, $goals2);
            $points[] = $sort->getPoints($goals2, $goals1);

            array_push($match_a, [
                "id_team1"=> $match[0]->id,
                "goals_team1"=>$goals1,
                "taken_team1" =>$goals2,
                "points_team1"=>$goals1-$goals2,
                "id_team2"=> $match[1]->id,
                "goals_team2"=>$goals2,
                "taken_team2" =>$goals1,
                "points_team2"=> $goals2-$goals1,
                "group"=> $group,
                "match"=>'QF'
            ]);
           array_push($pts, [
               "id_team"=>$match[0]->id,
               "points"=>$goals1-$goals2,
               "key"=> $match[0]->key,
               "match"=>'QF'
           ]);
           array_push($pts, [
            "id_team"=>$match[1]->id,
            "points"=>$goals2-$goals1,
            "key"=> $match[1]->key,
            "match"=>'QF'
        ]);
        }
        //insere e trata as fases do campeonato
        $MatchRepository->insert($match_a);
        $PointsRepository->insert($pts);
        $MatchRepository->semiFinals();
        $MatchRepository->finals();

        //chama o método que retorna e exibes os dados na view
        $this->show();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    { 
        $m = new MatchRepository;
        $matches = Matches::all();
        $teams = Team::find(1);
        $data = [];
        foreach($matches as $match){
            array_push($data, [
                "name"=>Team::find($match['id_team1'])['name'],
                "group"=>Team::find($match['id_team1'])['group'],
                "key"=>Team::find($match['id_team1'])['key'],
                "goals"=>$match['goals_team1'],
                "taken"=>$match['taken_team1'],
                "points"=>$match['points_team1'],
                "match"=>$match['match'],

            ]);
            array_push($data, [
                "name"=>Team::find($match['id_team2'])['name'],
                "group"=>Team::find($match['id_team2'])['group'],
                "key"=>Team::find($match['id_team2'])['key'],
                "goals"=>$match['goals_team2'],
                "taken"=>$match['taken_team2'],
                "points"=>$match['points_team2'],
                "match"=>$match['match'],

            ]);
        }
        
        $winner = $m->winner(Team::find($match['id_team2']));

        if($winner[0]['points'] === $winner[1]['points']){
            $winner = $winner[0];
            $menssagem = ': CRITÉRIO DE DESEMPATE';
        }
        else {
            $menssagem = '';
            $winner = $winner[0];
        }
        $winner = Team::find($winner['id_team']);
        return view("main.championship", ["data"=>$data, "winner"=>$winner])->with('mensagem', $menssagem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
