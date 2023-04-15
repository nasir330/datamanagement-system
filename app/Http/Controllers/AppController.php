<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $userType = UserType::get('id')->first();        
        $data = User::all();
        return view("main", ['data'=>$data, 'userType'=> $userType]);
    }

    public function setting()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
       return view('setting',['setting' => $setting]);
    }

    public function storeSetting(Request $request)
    {
        
        $data = new AppSetting;
        $data->userId = $request->userId;
        $data->appName = $request->appName;

        $url = "storage/";
        $appLogo = $request->file('appLogo');
        $appLogo_name = $appLogo->getClientOriginalName();      
        $appLogo_storage = $appLogo->storeAs("public/logo", $appLogo_name);
        $appLogo_path = 'storage/logo/'.$appLogo_name;        
        $data->appLogo = $appLogo_path;

        $data->sessionExpiration = $request->sessionExpiration*60;
        $data->pagination = $request->pagination;
        $data->filePath = $request->filePath;
        $data->fileName = $request->fileName;
        $data->themeMode = $request->themeMode;
        $data->accentColor = $request->accentColor;
        $data->subAccentColor = $request->subAccentColor;
        $data->save();

        $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'System setting update';
      $activityLog->save();
        
        session()->flash('success', 'System Setting Updated..!!');
        return redirect()->back();
    }
    public function updateSetting(Request $request)
    {
        //return $request->all();
        if(empty($request->appLogo)){
            $data = AppSetting::where('userId',$request->userId)->update([
                'appName'=>$request->appName,                
                'sessionExpiration'=>$request->sessionExpiration*60, 
                'pagination'=>$request->pagination, 
                'filePath'=>$request->filePath, 
                'fileName'=>$request->fileName, 
                'themeMode'=>$request->themeMode, 
                'accentColor'=>$request->accentColor, 
                'subAccentColor'=>$request->subAccentColor, 
            ]);    
        }else{
            $url = "storage/";
            $appLogo = $request->file('appLogo');
            $appLogo_name = $appLogo->getClientOriginalName();      
            $appLogo_storage = $appLogo->storeAs("public/logo", $appLogo_name);
            $appLogo_path = 'storage/logo/'.$appLogo_name;        
          
            $data = AppSetting::where('userId',$request->userId)->update([
                'appName'=>$request->appName, 
                'appLogo'=>$appLogo_path, 
                'sessionExpiration'=>$request->sessionExpiration*60, 
                'pagination'=>$request->pagination, 
                'filePath'=>$request->filePath, 
                'fileName'=>$request->fileName, 
                'themeMode'=>$request->themeMode, 
                'accentColor'=>$request->accentColor, 
                'subAccentColor'=>$request->subAccentColor, 
            ]);                    
        }       
        
        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'System setting update';
        $activityLog->save();
        session()->flash('success', 'System Setting Updated..!!');
        return redirect()->back();
    }
   
}
