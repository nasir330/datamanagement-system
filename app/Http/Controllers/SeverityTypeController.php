<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Severity;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class SeverityTypeController extends Controller
{
    //get all serverity
    public function index()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
        if(!empty($setting)){
          $severities = Severity::orderby('id','asc')->paginate($setting->pagination);
        }else{
          $severities = Severity::orderby('id','asc')->paginate(10);
        }
        
        return view('severity.index',['severities' => $severities]);
    }
       //create new severity
       public function store(Request $request)
       {
           $data = $request->all();          
           Severity::create($data);
   
           $logData =  UserLog::where('userId',Auth::user()->id)
           ->where('type','Time in')
           ->latest()
           ->first('id');        
           $activityLog = new ActivityLog;
           $activityLog->logId = $logData->id;
           $activityLog->activity = 'Severity Created';
           $activityLog->save();
           session()->flash('success','New Severity Created successfully..!!');
           return redirect()->back(); 
       }
         //edit form of severity
     public function edit($id)
     {
         $data = Severity::where('id',$id)->first();
               
       return view('severity.edit',['data'=>$data]);         
     }
     //update severity data
     public function update(Request $request)
     {        
         $data = Severity::where('id',$request->severityId)->update([ 'severity'=>$request->severity]);
         
         $logData =  UserLog::where('userId',Auth::user()->id)
         ->where('type','Time in')
         ->latest()
         ->first('id');        
         $activityLog = new ActivityLog;
         $activityLog->logId = $logData->id;
         $activityLog->activity = 'Severity updated';
         $activityLog->save();
         session()->flash('success','Severity updated successfully..!!');
         return redirect()->route('severitytype');         
     }
      //delete severity data   
    public function delete($id)    
    {
        Severity::destroy($id);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Delete Severity of id no '.$id;
        $activityLog->save();
        session()->flash('delete-success','Severity Deleted Successfully..!!');
        return redirect()->route('severitytype'); 
      }
}

