<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class DomainController extends Controller
{
    //get all domain
    public function index()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
        if(!empty($setting)){
            $domains = Domain::orderby('id','asc')->paginate($setting->pagination);
        }else{
            $domains = Domain::orderby('id','asc')->paginate(10);
        }
       
        return view('domain.index',['domains'=> $domains]);
    }
    //crate new domain
    public function store(Request $request)
    {
        $data = $request->all();
        Domain::create($data);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Domain Created';
        $activityLog->save();
        session()->flash('success','New Domain Created successfully..!!');
        return redirect()->back(); 
    }
    //edit domain form
    public function edit($id)
    {
        $data = Domain::where('id',$id)->first();
      return view('domain.edit',['data'=>$data]);         
    }
    //save update domain data
    public function update(Request $request)
    {        
        $data = Domain::where('id',$request->domain_id)->update([ 'domain'=>$request->domain,]);
        
        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Domain updated';
        $activityLog->save();
        session()->flash('success','Domain updated successfully..!!');
        return redirect()->route('domain');         
    }
    //delete domain data   
    public function domainDelete($id)    {
      Domain::destroy($id);

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'Delete domain of id no '.$id;
      $activityLog->save();

      session()->flash('delete-success','Domain Deleted Successfully..!!');
      return redirect()->route('domain'); 
    }

}
