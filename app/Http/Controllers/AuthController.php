<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    //login function
    function Login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password'=> 'required'
        ]);
 
        if ($validator->fails()) {

            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();

        }
        $user = User::where(['email'=>$request->email])->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            $request->session()->flash('log_error','Invalid email or password!');
            return redirect()->back();
        }else{
            $request->session()->put('user',$user);
            return redirect('/');
        }
    }

    //registration function 
    function Register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required|min:6|max:20|confirmed',
            'confirm_password'=>'required|min:6|max:20'
        ]);
 
        if ($validator->fails()) {

            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();

        }
        return "Registration Successful";
    }
}
