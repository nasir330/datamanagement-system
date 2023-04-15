<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserType;
use App\Models\Members;
use App\Models\UserLog;
use App\Models\ActivityLog;
use App\Models\NotificationMessage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    // info edit page
    public function editPersonalInfo($id)
    {
        $users = User::where('id',$id)->first();
        return view('profile.edit-personal-info', ['users'=>$users]);
    }

    //photo update
    public function editPhoto(Request $request)
    {        
        $url = "storage/";
        $photo = $request->file('photo');
        $photo_name = $photo->getClientOriginalName();      
        $photo_storage = $photo->storeAs("public/uploads", $photo_name);
        $photo_path = 'storage/uploads/'.$photo_name;

         Members::where('userId',$request->memberId)->update([
            'photo'=> $photo_path,
         ]);

         $logData =  UserLog::where('userId',Auth::user()->id)
         ->where('type','Time in')
         ->latest()
         ->first('id');        
         $activityLog = new ActivityLog;
         $activityLog->logId = $logData->id;
         $activityLog->activity = 'Profile Photo updated';
         $activityLog->save();
         
       return redirect()->route('profile.edit');
   
    }
    //info update submit
    public function updatePersonalInfo(Request $request)
    { 
        Members::where('userId',Auth::user()->id)     
      ->update([
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
    $activityLog->activity = 'personal info updated';
    $activityLog->save();

        session()->flash('success','Personal Info updated successfully..!!');
        return redirect()->route('profile.edit');
        
    }
    //get edit profile info page
    public function editProfileInfo($id)
    {
        $users = User::where('id',$id)->first();
        $type = UserType::WhereNot('id','1')->get();
        return view('profile.edit-profile-info', ['users'=>$users, 'type'=>$type]);
    }
    //save-update profile info
    public function updateProfileInfo(Request $request)
    { 
          
        $users = User::where('id',$request->id)
        ->update([
            'username'=> $request->username,
            'email'=> $request->email,
        ]);

        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Changed username';
        $activityLog->save();
        
        session()->flash('success', 'Membership details updated successfully..!!');
        return redirect()->route('profile.edit');
    }

    //get user profile membership update page
    public function updateProfileMembership($id)
    {
        $users = User::where('id',$id)->first();
        $type = UserType::WhereNot('id','1')->get();
        return view('profile.edit-profile-membership', ['users'=>$users, 'type'=>$type]);
    }
    //request membership update
    public function requestUpdateMembership(Request $request)
    {
        //insert query into notification table
       $notification = new NotificationMessage;       
       $notification->type = 'notification';
       $notification->userId = Auth::user()->id;
       $notification->presentType = Auth::user()->type;
       $notification->requestType = $request->request_user_type;
       $notification->save();
// insert log data
       $logData =  UserLog::where('userId',Auth::user()->id)
       ->where('type','Time in')
       ->latest()
       ->first('id');        
       $activityLog = new ActivityLog;
       $activityLog->logId = $logData->id;
       $activityLog->activity = 'Membership update requested';
       $activityLog->save();
       
       session()->flash('success', 'Membership update request sent..!!');
       return redirect()->back();

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}