<?php

namespace App\Http\Controllers;

use App\Models\Maillon;
use Illuminate\Http\Request;

class MaillonController extends Controller
{
    public function index()
    {
        $maillons = Maillon::select('name')->orderBy('id', 'desc')->get();
        return $maillons;
    }
}
