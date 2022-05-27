<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TeamServices;
use Illuminate\Support\Facades\DB;
use App\Repository\TeamRepository;

class MatchController extends Controller
{
    public function create(TeamRepository $repository){
        $times = $repository->select($group);
        $time_a = $sort->makeDisputeQF($times[0]['group_a']->toArray());
        $time_b = $sort->makeDisputeQF($times[0]['group_b']->toArray());

    }


}
