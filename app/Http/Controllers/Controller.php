<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getCurrentUserSettingsData(){
        $authObj=\Auth::guard('admin')->user();
        // dd($authObj);
        $settingObj= json_decode($authObj->setting_json,true);
        // dd($settingObj);
        return (object)$settingObj;
    }
}
