<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    //get all type list
    public function index()
    {
      $setting = AppSetting::where('userId',Auth::user()->id)->first();
      if(!empty($setting)){
        $types = Type::orderby('id','asc')->paginate($setting->pagination);
      }else{
        $types = Type::orderby('id','asc')->paginate(10);
      }
       
        return view('type.index', ['types' => $types]);
    }
    //create new Type
    public function store(Request $request)
    {
        $data = $request->all();
        Type::create($data);
   
        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Type Created';
        $activityLog->save();
           session()->flash('success','New Type Created successfully..!!');
           return redirect()->back();
    }
       //edit form of type
       public function edit($id)
       {
           $data = Type::where('id',$id)->first();
               
         return view('type.edit',['data'=>$data]);         
       }
        //update type data
     public function update(Request $request)
     {        
         $data = Type::where('id',$request->typeId)->update([ 'type'=>$request->type]);
         
         $logData =  UserLog::where('userId',Auth::user()->id)
         ->where('type','Time in')
         ->latest()
         ->first('id');        
         $activityLog = new ActivityLog;
         $activityLog->logId = $logData->id;
         $activityLog->activity = 'Type updated';
         $activityLog->save();
         session()->flash('success','Type updated successfully..!!');
         return redirect()->route('type');         
     }
      //delete type data   
    public function delete($id)    
    {
        Type::destroy($id);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Delete Type id no '.$id;
        $activityLog->save();
        session()->flash('delete-success','Type Deleted Successfully..!!');
        return redirect()->route('type'); 
      }
}
