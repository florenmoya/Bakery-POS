<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;


use Auth;
use App\User;
use App\Companies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        
        $company = new Companies;
        $company->name = $request->company_name;
        $company->address = $request->company_address;
        $company->city = $request->company_city;
        $company->region = $request->company_region;
        $company->zip_code = $request->company_zip_code;
        $company->phone = $request->company_phone;
        $company->save();

         $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'username' => $validate['username'],
            'password' => Hash::make($validate['password']),
            'company_id' => $company->id,
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8']
            ]);
        if(!auth()->attempt($login)){
            return response(['message' => 'Invalid credentials'], 401);
        }
        else{
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        }
    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }

    public function isLoggedIn(Request $request){
        if($request->user()->username){
            return response("Logged in", 200);
        }
    }
}
