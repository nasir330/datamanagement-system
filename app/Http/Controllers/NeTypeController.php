<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\NeType;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class NeTypeController extends Controller
{
    //get all netype list
    public function index()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
        if(!empty($setting)){
            $neTypes = NeType::orderby('id','asc')->paginate($setting->pagination);
        }else{
            $neTypes = NeType::orderby('id','asc')->paginate(10);
        }

        $domains = Domain::all();       
        return view('netype.index',['neTypes'=>$neTypes,'domains'=>$domains]);
    }
    //create new NeType
    public function store(Request $request)
    {
        $data = $request->all();
        NeType::create($data);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'NeType Created';
        $activityLog->save();
        session()->flash('success','New NeType Created successfully..!!');
        return redirect()->back(); 
    }
     //edit form NeType
     public function edit($id)
     {
         $data = NeType::where('id',$id)->first();
         $domains = Domain::all();         
       return view('netype.edit',['data'=>$data, 'domains'=>$domains]);         
     }
       //update NeType
    public function update(Request $request)
    {              
        $data = NeType::where('id',$request->ne_typeId)
        ->update([
             'ne_type'=>$request->ne_type,
             'domainId'=>$request->domainId,
            ]);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'NeType updated';
        $activityLog->save();
        
        session()->flash('success','NeType updated successfully..!!');
        return redirect()->route('netype');         
    }
    //delete NeType
    public function delete($id)    {
        NeType::destroy($id);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Delete NeType of id no '.$id;
        $activityLog->save();
        session()->flash('delete-success','NeType Deleted Successfully..!!');
        return redirect()->route('netype'); 
      }

}
