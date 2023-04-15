<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;
use App\Models\ActivityLog;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        $logData =  UserLog::where('userId',Auth::user()->id)
        ->where('type','Time in')
        ->latest()
        ->first('id');        
        $activityLog = new ActivityLog;
        $activityLog->logId = $logData->id;
        $activityLog->activity = 'Update password';
        $activityLog->save();
        
        session()->flash('success', 'Password updated successfully..!!');
        return redirect()->route('profile.edit');
        //return back()->with('status', 'password-updated');
    }
}
