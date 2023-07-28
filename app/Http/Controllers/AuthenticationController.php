<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('username',$request->username)->first();

        if (! $user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'message'=>'incorrect username or password'
            ]);
        }

        return $user->createToken('token')->plainTextToken;
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'fullname'=>'required'
        ]);
        $existingUser = User::where('username', $request->username)->first();
        if ($existingUser) {
            throw ValidationException::withMessages([
                'message' => 'Username already registered!'
            ]);
        }
    
        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        
        $user->save();


        return response()->json($user);
    }

    public function logout(Request $request){
       $request->user()->currentAccessToken()->delete();
    }

    public function me(Request $request){
        return response()->json(Auth::user());
     }
}
