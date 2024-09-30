<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::select('name')->orderBy('id', 'desc')->get();
        return $communes;
    }
}
