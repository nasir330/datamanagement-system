<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\User;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationMessage;

class NotificationController extends Controller
{
    //get all notifications from database
    public function index()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
      if(!empty($setting)){
        $notifications = NotificationMessage::paginate($setting->pagination);
      }else{
        $notifications = NotificationMessage::paginate(10);
      }
       return view('notifications.index',['notifications' => $notifications]);       
        //return $notifications;
    }
    //open notification
    public function openNotification($id)
    {
        $notification = NotificationMessage::where('id',$id)->first();
        return view('notifications.openNotification',['notification' => $notification]);
    }
    //approve notification
    public function approve(Request $request)
    {
      //get from notification table
      $notification = NotificationMessage::where('id',$request->id)->first();
    //update notification table
      $notifyAction = NotificationMessage::where('id',$request->id)
      ->update([
        'status' => 'Approve',
        'actionBy' => Auth::user()->id,
      ]);
    //approve action to user
    User::where('id',$notification->userId)->update(['type' => $notification->requestType]);
    
    $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'profile update request for id no '.$notification->userId;
        $activityLog->save();

    session()->flash('success','profile update request approved..!!');
    return redirect()->route('notification-list'); 


    }
    //search notification
    public function searchNotification(Request $request)
    {
        $searchUser = User::where('username',$request->username)->first();
        $searchNotification = NotificationMessage::where('userId',$searchUser->id)->get();
        return view('notifications.searchNotification',['searchNotification'=>$searchNotification]);
    }
}
