<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

use App\Models\UserLog;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {    
        $request->authenticate();
        $data = User::where('id',Auth::user()->id)->first();
      
       if($data->status == 'Approved'){ 
        $request->session()->regenerate();
        $logData = new UserLog;
        $logData->userId = $data->id;       
        $logData->type = 'Time in';
        $logData->save();

        return redirect()->intended(RouteServiceProvider::HOME);
       }else{        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        session()->flash('error','Account is not approved by admin..!');
        return redirect('/');
       }
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->regenerateToken();
        $logData = new UserLog;
        $logData->userId = Auth::user()->id;       
        $logData->type = 'Time out';
        $logData->save();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
       
        return redirect('/');
    }
}
