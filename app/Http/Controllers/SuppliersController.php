<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Role;
use App\User;
use Sentinel;
use Session;
use App\Http\Requests\SupplierRequest;

class SuppliersController extends Controller
{
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
    }
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
        $supplier = Supplier::with(['role', 'user'])->where('role_id','!=','1')->Where('role_id','!=','3')->get();
        return view('supplier.supplier')->with('supplier',$supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::select('name')->where('id','!=','1')->where('id','!=','3')->get();
        return view('supplier.suppliernew')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        //
        $user = Sentinel::registerAndActivate($request->toArray());
        $role = Sentinel::findRoleByName($request->input('role'));
        $user->roles()->attach($role);
        return redirect()->route('suppliers.index');
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
        $role = Role::select('name')->where('id','!=','1')->where('id','!=','3')->get();
        $supplier = Supplier::with(['role', 'user'])->find($id);
        return view('supplier.supplieredit')->with('supplier',$supplier)->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        //
        if(empty($request->input('password'))){
          $request->offsetUnset('password');
        }else{
          $request->merge(['password' => bcrypt($request->input('password'))]);
        }

        $userid = User::find($id);
        $sentinelid = Sentinel::findById($id);
        $findrole = Supplier::with('role')->find($id);
        $role = Sentinel::findRoleByName($findrole->role->name);
        $role->users()->detach($sentinelid);

        $userid->update($request->all());
        $newrole = Sentinel::findRoleByName($request->input('role'));
        $sentinelid->roles()->attach($newrole);
        return redirect()->route('suppliers.index');
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
        Supplier::destroy($id);
        //return $id;
        return redirect()->route('suppliers.index');
    }
}
