<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    function LoginUser(Request $request){
        // $request->validate([
        //     'email'=> 'required',
        //     'password'=> 'required',
        // ]);

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
            return redirect('/product');
        }
    }
}
