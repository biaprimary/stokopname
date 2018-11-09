<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;
use App\Http\Requests\SessionRequest;

class SessionsController extends Controller
{
    //
    public function login()
    {
      if ($user = Sentinel::check())  {
        Session::flash("notice", "You has login ".$user->email);
        if(Sentinel::inRole('buyer')){
          return redirect()->intended('shopping');
        }else{
          return redirect()->intended('dashboard');
        }
      }
      else {
        return view('auth.login');
      }
    }

    public function login_store(SessionRequest $request)
    {
      if($user = Sentinel::authenticate($request->all())) {
        Session::flash("notice", "Welcome ".$user->email);
        if(Sentinel::inRole('buyer')){
          return redirect()->intended('shopping');
        }else{
          return redirect()->intended('dashboard');
        }
      }
      else {
        Session::flash("notice", "Login fails");
        return view('auth.login');
      }
    }

    public function logout() {
      Sentinel::logout();
      Session::flash("notice", "Logout success");
      return redirect('login');
    }
}
