<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login(Request $request){
        $user = User::where(['username' => $request->username])
            ->first();

        // dd($user->password);

        if(!$user || !Hash::check($request->password, $user->password)){
            return Redirect::back()->withErrors(['msg' => 'Username or password is incorrect']);

        }else {
            $userdata = [
                'user_id' => $user->id,
                'name' => $user->name,
                'username' => $user->username
            ];

            $request->session()->put('user', $userdata);
            return redirect('/');
        }
    }

    public function register(Request $request){

        // dd($user);
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login');
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
