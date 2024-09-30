<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use Illuminate\Http\Request;

class ArrondissementController extends Controller
{
    public function index()
    {
        $arrondissements = Arrondissement::select('name')->orderBy('id', 'desc')->get();
        return $arrondissements;
    }
}
