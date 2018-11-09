<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\Role;
use App\User;
use Sentinel;
use Session;
use App\Http\Requests\BuyerRequest;

class BuyersController extends Controller
{
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
    }
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$supplier = Supplier::all();
        //$supplier->load('role');
        //$supplier->load('user');
        $buyer = Buyer::with(['role', 'user'])->where('role_id','!=','1')->Where('role_id','!=','2')->get();
        return view('buyer.buyer')->with('buyer',$buyer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::select('name')->where('id','!=','1')->where('id','!=','2')->get();
        return view('buyer.buyernew')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerRequest $request)
    {
        //
        $user = Sentinel::registerAndActivate($request->toArray());
        $role = Sentinel::findRoleByName($request->input('role'));
        $user->roles()->attach($role);
        return redirect()->route('buyers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::select('name')->where('id','!=','1')->where('id','!=','2')->get();
        $buyer = Buyer::with(['role', 'user'])->find($id);
        return view('buyer.buyeredit')->with('buyer',$buyer)->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerRequest $request, $id)
    {
        //
        if(empty($request->input('password'))){
          $request->offsetUnset('password');
        }else{
          $request->merge(['password' => bcrypt($request->input('password'))]);
        }

        $userid = User::find($id);
        $sentinelid = Sentinel::findById($id);
        $findrole = Buyer::with('role')->find($id);
        $role = Sentinel::findRoleByName($findrole->role->name);
        $role->users()->detach($sentinelid);

        $userid->update($request->all());
        $newrole = Sentinel::findRoleByName($request->input('role'));
        $sentinelid->roles()->attach($newrole);
        return redirect()->route('buyers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        Buyer::destroy($id);
        //return $id;
        return redirect()->route('buyers.index');
    }
}
