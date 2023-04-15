<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Auth;
use Session;

class SessionExpired
{  
    protected $session;
    protected $timeout = 300;

    public function __construct(Store $session){
        $this->session = $session;
    }

    public function handle($request, Closure $next){
        $timeout = AppSetting::where('userId',Auth::id())->first();
        $isLoggedIn = $request->path() != 'dashboard/logout';
      if(!empty($timeout->sessionExpiration)){
        if(! session('lastActivityTime'))
        $this->session->put('lastActivityTime', time());
    elseif(time() - $this->session->get('lastActivityTime') > $timeout->sessionExpiration){
        $this->session->forget('lastActivityTime');
        $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'dashboard');
        Auth::guard('web')->logout();

        $request->session()->invalidate();
       
        return redirect('/');
    }
      }else{
        if(! session('lastActivityTime'))
        $this->session->put('lastActivityTime', time());
    elseif(time() - $this->session->get('lastActivityTime') > 180){
        $this->session->forget('lastActivityTime');
        $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'dashboard');
        Auth::guard('web')->logout();

        $request->session()->invalidate();
       
        return redirect('/');
    }
      }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   
}
