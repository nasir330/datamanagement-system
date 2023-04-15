<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\HuAlarm;
use App\Models\NotificationMessage;


class DashboardController extends Controller
{
    //get all user alarms
    public function index ()
    {
        $data = User::select('username')
        ->withCount('hualarm')    
        ->get();
        return response()->json($data);        
    }
    //get searched user alarm
    public function dashboardSearchUser (Request $request)
    { 
        $data = User::where('username',$request->username)
        ->select('username')
        ->withCount('hualarm')    
        ->get();
        return response()->json($data);        
    }
    //get searched alarm by date
    public function dashboardSearchbyDate (Request $request)
    { 
        
        $fromDate = $request->date_from;
        $toDate = $request->date_to;
        $searchData = HuAlarm::selectRaw('username, COUNT(*) as hualarm_count')
        ->groupBy('username')
        ->get();

        return response()->json($searchData);                     
    }
    //count open nofificaion
    public function notifications()
    {
       $getNotify = NotificationMessage::where('userId', Auth::user()->id)->first();
       //return $getNotify->userId;
       if(!$getNotify){
        if(Auth::user()->type == 1 || Auth::user()->type == 2)
        {
            $notification = NotificationMessage::where('status','open')
            ->where('type','notification')
            ->count();
            return response()->json($notification); 
        }
       
       }else{
        
       }
       
    }
    //get all nofificaion
    public function allNotifications()
    {
        $allNotification = NotificationMessage::with('user')
        ->latest()
        ->limit(3)
        ->get();
        return response()->json($allNotification); 
    }
}