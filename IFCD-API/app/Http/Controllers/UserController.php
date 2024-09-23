<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionMessage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //Create d'admin
    public function createAdmin(Request $request)
    {

        //validation request

        $this->validate($request, [
            'name' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required'
        ]);

        $password = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id,
            'role' => $request->role
        ]);
        $setting = Setting::where('id', 1)->first();
        $request->merge(['baseUrl' => $setting->baseUrl]);
        Mail::to($request->email)->send(new InscriptionMessage($request->except('_token')));

        return $user;
    }
}
