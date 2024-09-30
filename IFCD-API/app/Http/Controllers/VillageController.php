<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index()
    {
        $villages = Village::select('name')->orderBy('id', 'desc')->get();
        return $villages;
    }
}
