<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use App\Models\Members;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $type = UserType::WhereNot('id','1')->get();
        return view('registerUser.register', ['type'=>$type]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {        
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);
    //user table fillable credential
        $user = User::create([
            'type' => $request->type,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),           
            'status' => $request->status,
        ]);
   
        Members::create([
            'userId'=>$user->id,
          ]);

        event(new Registered($user));

        //Auth::login($user);
        session()->flash('success','Account created successfully..!!');        
        return redirect(RouteServiceProvider::MAIN);
    }
}
