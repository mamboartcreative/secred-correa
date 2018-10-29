<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Auth;

class RankTeamController extends Controller
{
    public function index(){
        $teams = Profile::where('references', Auth::user()->profile->hp)->get();

        return view('general.rank.index')
            ->with('teams', $teams);
    }
}
