<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\User;
use App\Models\UserLog;
use App\Models\ActivityLog;
use App\Models\UserType;
use App\Models\Members;
use App\Models\UserAccStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Exports\UserLogExport;
use Excel;

class MembersController extends Controller
{
   //all user list
    public function index()
    {
      $setting = AppSetting::where('userId',Auth::user()->id)->first();
      if(!empty($setting)){
        $users = User::whereNot('id',1)->paginate($setting->pagination);
      }else{
        $users = User::whereNot('id',1)->paginate(10);
      }
       return view('registerUser.index',['users' => $users]);
    }
    // search user
    public function userSearch(Request $request)
    {
      
      $users = User::where('username', $request->username)->first();
      return view('registerUser.searchUser',['users' => $users]); 
    }
   // user status approve
    public function userApprove(Request $request)
    {      
      $users = User::where('id',$request->id)     
      ->update(['status'=>'Approved']);

      $user = User::where('id', $request->id)->first();
      $accountStatus = New UserAccStatus;
      $accountStatus->userId = $user->id;
      $accountStatus->usertypeId = $user->type;
      $accountStatus->approveby = Auth::user()->id;
      $accountStatus->save();

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'Approved user id no: '.$request->id;
      $activityLog->save();
      
      session()->flash('success','Account approved successfully..!!');
        return redirect()->route('allUsers'); 
    }
//user data edit page
    public function userEdit($id)
    {
      $type = UserType::WhereNot('id','1')->get();
      $users = User::where('id',$id)
      ->with('usertype')
      ->first();      
      //return $users;
      return view('registerUser.edit', ['users'=>$users, 'type'=> $type]);
    }
    // user update data save
    public function userEditSave(Request $request)
    {
      Members::where('userId',$request->id)->update([       
          'first_name'=>$request->first_name,
          'middle_name'=>$request->middle_name,
          'last_name'=>$request->last_name,
          'suffix'=>$request->suffix,
          'birth_date'=>$request->dob,
          'gender'=>$request->gender,
      ]);
      User::where('id',$request->id)->update([           
              'type' => $request->user_type,
      ]);

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'users profile edited of id no: '.$request->id;
      $activityLog->save();
      session()->flash('success','Account details updated successfully..!!');
      return redirect()->route('allUsers');     
    }
    
    //delete user 
    public function userDelete($id)
    {
      
      User::where('id', $id)->delete();
      UserLog::where('userId', $id)->delete();
      Members::where('userId', $id)->delete();
      UserAccStatus::where('userId', $id)->delete();

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'Delete user id no: '.$id;
      $activityLog->save();
      session()->flash('delete-success','Account Deleted Successfully..!!');
      return redirect()->route('allUsers'); 
    }
    
    //all members list
    public function members()
    {
      $setting = AppSetting::where('userId',Auth::user()->id)->first();
      if(!empty($setting)){      
        $users = User::whereNot('type',1)
        ->whereNot('type',2)
        ->paginate($setting->pagination);
      }else{
        $users = User::whereNot('type',1)
        ->whereNot('type',2)
        ->paginate(10);
      }  
       return view('members.index', ['users'=> $users]);
    }
    //search members by date
    public function searchMembersByDate(Request $request)
    {
      $fromDate = $request->date_from;
      $toDate = $request->date_to;
      $dateSearchMembers = Members::whereBetween('created_at', [$fromDate,$toDate])->get(); 
     
      return view('members.dateSearchMember', ['dateSearchMembers'=> $dateSearchMembers]);
    }
    //search member by name
    public function searchMembers(Request $request)
    {  
      $memberSearch = Members::where('first_name',$request->name)
      ->orWhere('middle_name',$request->name)
      ->orWhere('last_name',$request->name)
        ->get();
   
      return view('members.searchMember', ['memberSearch'=> $memberSearch]);
    }
    //member create form
    public function create()
    {
      if(Auth::user()->type == 1 || Auth::user()->type == 2){
        $type = UserType::WhereNot('id','1')->get();
        return view('members.create', ['type'=> $type]);
      }else{
        session()->flash('delete-success','You tried to access Un-authorized page');
return redirect()->route('allUsers');
      }
      
    }
    //create member data store
    public function store(Request $request)
    {
     
     $users = User:: create([
        'type' => $request->user_type,
        'username' => $request->first_name.$request->middle_name.$request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
        'status' => $request->status,
    ]); 
     
      Members::create([
        'userId'=>$users->id,
        'first_name'=>$request->first_name,
        'middle_name'=>$request->middle_name,
        'last_name'=>$request->last_name,
        'suffix'=>$request->suffix,
        'birth_date'=>$request->dob,
        'gender'=>$request->gender,
      ]);

      $logData =  UserLog::where('userId',Auth::user()->id)
      ->where('type','Time in')
      ->latest()
      ->first('id');        
      $activityLog = new ActivityLog;
      $activityLog->logId = $logData->id;
      $activityLog->activity = 'Create new user id no: '.$users->id;
      $activityLog->save();
    session()->flash('success','Member created successfully..!!');
    return redirect()->back();    
    }

    //all user log
    public function userLog()
    {
      
      $setting = AppSetting::where('userId',Auth::user()->id)->first();
      if(!empty($setting)){
        $logData = UserLog::orderby('id','asc')->paginate($setting->pagination);
      }else{
        $logData = UserLog::orderby('id','asc')->paginate(10);
      }
       
       return view('registerUser.logtime',['logData' => $logData]);
    }
    //search user log by date
    public function userLogsearchByDate(Request $request)
    {
      
      $fromDate = $request->date_from;
      $toDate = $request->date_to;
      $searchByDate = UserLog::whereBetween('created_at', [$fromDate,$toDate])->get();
     
      return view('registerUser.dateSearchLog', ['searchByDate'=> $searchByDate]);

    }
      // search user log by username
      public function userLogsearchByUsername(Request $request)
      {
       
        $users = User::where('username', $request->username)->first();
        $searchByUsername = UserLog::where('userId',$users->id)->get();
        return view('registerUser.userSearchLog',['searchByUsername' => $searchByUsername]); 
      }
    //get user activity log
    public function userActivityLog($id)
    {
      $data = ActivityLog::where('logId',$id)->get();
      return view('registerUser.activitylog',['data'=>$data]);
      
    }
    //export all user log
    public function exportUserLog()
    {
      return Excel::download(new UserLogExport, 'userLog.xls');
    }

}