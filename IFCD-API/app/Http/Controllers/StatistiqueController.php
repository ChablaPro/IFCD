<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Actor;
use App\Models\Compagny;
use App\Models\User;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index(){
        $actors = Actor::count();
        $companies = Compagny::count();
        $activities = Activity::count();
        $users = User::count();

        return response()->json([
            'actors' => $actors,
            'companies' => $companies,
            'activities' => $activities,
            'users' => $users
        ]);
    }
}
