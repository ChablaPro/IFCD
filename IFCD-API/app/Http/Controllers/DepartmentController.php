<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departs = Department::select('name')->orderBy('id', 'desc')->get();
        return $departs;
    }
}
