<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')) {
            return redirect('admin/dashboard');
  
          }else{
            return view('admin.login');
          }
        return view('admin.login');
    }

    public function store(Request $request)
    {
        //
    }

    public function auth(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password'=> 'required'
        ]);
 
        if ($validator->fails()) {

            return redirect('admin')
                        ->withErrors($validator)
                        ->withInput();

        }
        $email = $request->email;
        $password = $request->password;
        // $result = Admin::where(['email' => $email,'password'=>$password])->get();
        $result = Admin::where(['email' => $email])->first();
        if($result){
            if(Hash::check($password,$result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN', $result);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error', 'Invalid Password!');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error', 'Please Enter Valid Login Detail!');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
