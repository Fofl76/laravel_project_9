<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Contoller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(){
        return view("auth.signup");
    }

    public function registr( Request $request){
        $request ->validate([
            "name" => "required",
            "email" => "required|email|unique:\App\Models\User",
            "password" => "required|min:6"
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'reader',
        ]);
        $user->remember_token = $user->createToken('MyAppToken')->plainTextToken;
        $user->save();
        // return redirect()->route('login');
    }   
    public function login(){
        // return view('auth.login');
        
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:10'
        ]); 
        if(Auth::attempt($credentials, $request->remember))
        {
            $token = $request->usesr()->createToken('MyAppToken')->plainTextToken;
            // $request->session()->regenerate();
            return response($token);
        }
        return response([
            'email' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->user()->tokens()->delete();
        return response('logout');
    }
        // $response = [
        //     "name" => $request -> name,
        //     "email"=> request("email"),
        // ];
        // return response()->json($response);
}