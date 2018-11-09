<?php

namespace App\Http\Controllers;

use Sentinel;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    public function signup()
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
        $role = DB::table('roles')->select('name')->where('id','!=','1')->get();
        return view('auth.signup', compact('role',$role));
      }
    }

    public function signup_store(UserRequest $request)
    {
      $user = Sentinel::registerAndActivate($request->toArray());
      $role = Sentinel::findRoleByName($request->input('role'));
      $user->roles()->attach($role);
      Session::flash('notice', 'Account Has Been Created, Use Your Email to Log in');
      return redirect('login');

      //return $request;
     }

}
