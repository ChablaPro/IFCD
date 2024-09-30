<?php

namespace App\Http\Controllers;

use App\Models\Juridique;
use Illuminate\Http\Request;

class JuridiqueController extends Controller
{
    public function index()
    {
        $juris = Juridique::select('name')->orderBy('id', 'desc')->get();
        return $juris;
    }
}
