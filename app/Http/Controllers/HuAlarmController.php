<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NeType;
use App\Models\Type;
use App\Models\Severity;
use App\Models\HuAlarm;
use App\Models\AppSetting;
use App\Models\UserLog;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Exports\HuAlarmExport;
use App\Imports\HuAlarmImport;
use Excel;

class HuAlarmController extends Controller
{
    //get all list of alarm
    public function index()
    {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
        if(!empty($setting)){
            $huAlarms = HuAlarm::orderby('id','asc')->paginate($setting->pagination);
        }else{
            $huAlarms = HuAlarm::orderby('id','asc')->paginate(10); 
        }
               
        return view('huAlarm.index',['huAlarms'=>$huAlarms]);
    }
    //create form New HuAlarm
    public function create()
    {
        $neTypes = NeType::all();
        $types = Type::all();
        $severites = Severity::all();
        return view('huAlarm.create',['neTypes'=>$neTypes, 'types'=>$types, 'severites'=>$severites]);
    }
    //store New HuAlarm into database
    public function store(Request $request)
    {
        $data = $request->all();        
        HuAlarm::create($data);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'HuAlarm Created';
        $activityLog->save();

        session()->flash('success', 'HuAlarm created successfully..!!');
        return redirect()->route('huAlarm');
    }
    //get HuAlarm edit page
    public function edit($id)
    {
        $editAlarm = HuAlarm::where('id',$id)->first();
        $neTypes = NeType::all();
        $types = Type::all();
        $severites = Severity::all();
        return view('huAlarm.edit',['editAlarm'=>$editAlarm, 'neTypes'=>$neTypes, 'types'=>$types, 'severites'=>$severites]);
    }
    //update HuAlarm data
    public function update(Request $request)
    {   
        HuAlarm::where('id', $request->id)->Update([
            'username' => $request->username,
            'logSNumber' => $request->logSNumber,
            'oIName' => $request->oIName,
            'objIden' => $request->objIden,
            'nType' => $request->nType,
            'identity' => $request->identity,
            'aSource' => $request->aSource,
            'eAlrmSN' => $request->eAlrmSN,
            'aName' => $request->aName,
            'type' => $request->type,
            'sev' => $request->sev,
            'status' => $request->status,
            'oTime' => $request->oTime,
            'ackTime' => $request->ackTime,
            'cTime' => $request->cTime,
            'unAckOper' => $request->unAckOper,
            'clrOper' => $request->clrOper,
            'locInfor' => $request->locInfor,
            'lnkFDN' => $request->lnkFDN,
            'lnkName' => $request->lnkName,
            'ltype' => $request->ltype,
            'alrmIdent' => $request->alrmIdent,
            'alrmId' => $request->alrmId,
            'oType' => $request->oType,
            'autoClear' => $request->autoClear,
            'aCType' => $request->aCType,
            'busaffected' => $request->busaffected,
            'addText' => $request->addText,
            'arriUtcTime' => $request->arriUtcTime,
            'lstid' => $request->lstid,
            'relLogId' => $request->relLogId,
            'aid' => $request->aid,
            'aid' => $request->aid,
            'rid' => $request->rid,
        ]);
        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'HuAlarm Updated';
        $activityLog->save();

        session()->flash('success', 'HuAlarm Updated successfully..!!');
        return redirect()->route('huAlarm');
    }
    //delete HuAlarm
    public function delete($id)
    {
        HuAlarm::destroy($id);

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'Delete HuAlarm of id no '.$id;
      $activityLog->save();

      session()->flash('delete-success','HuAlarm Deleted Successfully..!!');
      return redirect()->route('huAlarm'); 
    }

    // search Alarm by date
    public function searchHuAlarmbyDate(Request $request)
    {
        $fromDate = $request->date_from;
        $toDate = $request->date_to;
        $alarmSearchByDate = HuAlarm:: whereBetween('oTime', [$fromDate,$toDate])->get(); 
        
        return view('huAlarm.searchByDate',['alarmSearchByDate'=>$alarmSearchByDate]);
    }
    // search Alarm by Name
    public function searchHuAlarmbyName(Request $request)
    {        
        $alarmSearchoIName = HuAlarm:: where('OIName', $request->OIName)->get(); 
        
        return view('huAlarm.searchByName',['alarmSearchoIName'=>$alarmSearchoIName]);
    }

     //export HuAlarm
     public function exportHuAlarm()
     {
       return Excel::download(new HuAlarmExport, 'huAlarm.xls');
     }
     //import HuAlarm
     public function importHuAlarm(Request $request)
     {
        
       Excel::import(new HuAlarmImport, $request->file('importFile_alarm'));
       session()->flash('success', 'HuAlarm imported successfully..!!');
       return redirect()->route('huAlarm');
     }

     //summery get by Netype
     public function summeryNeType()
     {
        $setting = AppSetting::where('userId',Auth::user()->id)->first();
        if(!empty($setting)){
            $neTypes = HuAlarm::orderby('id','asc')->paginate($setting->pagination);
        }else{
            $neTypes = HuAlarm::orderby('id','asc')->paginate(10); 
        }        
        return view('huAlarm.summeryNeType',['neTypes'=>$neTypes]);
     }
     //summery search by Netype
     public function summerySearchNeType(Request $request)
     {
        $getNeType = NeType::where('ne_type',$request->neType_name)->first();
        if(empty($getNeType)){
            session()->flash('delete-success', 'NeType name is not found..!!');
            return redirect()->back();
        }else{
            $summerySearch = HuAlarm::where('ntype',$getNeType->id)->get();        
            return view('huAlarm.summerySearchNeType',['summerySearch'=>$summerySearch]);
        }       
     }
      // summery search by by date
    public function summerySearchDate(Request $request)
    {
        
        $fromDate = $request->date_from;
        $toDate = $request->date_to;
        $summerySearchDate = HuAlarm:: whereBetween('oTime', [$fromDate,$toDate])->get(); 
        //return $summerySearchDate;
        return view('huAlarm.summerySearchDate',['summerySearchDate'=>$summerySearchDate]);
    }
}