<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request){
        $setting =  Setting::where('id', 1)->update([
             'comNumber'=>$request->comNumber,
             'comEmail'=>$request->comEmail,
             'approveEmail'=>$request->approveEmail,
             'urlBase' =>$request->urlBase,
             'linkedInClientID' =>$request->linkedInClientID,
             'linkedInRedirectUri' =>$request->linkedInRedirectUri,
             'linkedInClientSecret' =>$request->linkedInClientSecret,
             'linkedInScope' =>$request->linkedInScope,
             'tweeterClientID' =>$request->tweeterClientID,
             'tweeterClientSecret' =>$request->tweeterClientSecret,
             'twilioSid' =>$request->twilioSid,
             'twilioToken' =>$request->twilioToken,
             'twilioNumber' =>$request->twilioNumber,
             'roles' => $request->roles,
         ]);
         return response()->json([
             'settings'=>$setting
         ]);
     }
 
     public function settings(){
         $setting = Setting::where('id', 1)->first();
         return response()->json([
              'settings'=>$setting
         ]);
     }
}
