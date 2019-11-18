<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Item;
use App\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function employee_list(Request $request){
        $user = User::where('company_id', $request->user()->company_id)->with('Roles')->get();
        return response($user);
	}
	public function employee_store(Request $request){
        $insert = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => $request->roles,
        'company_id' => $request->user()->company_id,
    ]);
        return response($insert);
	}
	public function employee_update(Request $request){
        $update = User::where('id', $request->id)
        ->update([
        'name' => $request->name,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => $request->roles,
        'company_id' => $request->user()->company_id,
    ]);
        return response($update);
	}
	    public function employee_destroy(Request $request)
    {
        $destroy = User::where('id', $request->id)->delete();
        return response($destroy);
    }
	 public function employee_role(){
        $role = Roles::all();
        return response($role);
	}
		public function employee_role_store(Request $request){
        $insert = Roles::create([
        'name' => $request->name,
        'permission' => $request->permission,
    ]);
        return response($insert);
	}
	public function employee_role_update(Request $request){
        $update = Roles::where('id', $request->id)
        ->update([
        'name' => $request->name,
        'permission' => $request->permission,
    ]);
        return response($update);
	}
	    public function employee_role_destroy(Request $request)
    {
        $destroy = Roles::where('id', $request->id)->delete();
        return response($destroy);
    }
}
