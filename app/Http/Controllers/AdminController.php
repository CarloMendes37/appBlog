<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;

class AdminController extends Controller
{
    //Login view
    function login(){
        return view('backend.login');
    }

    function submit_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $usercheck=Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
        if($usercheck > 0){
            return redirect('admin/dashboard');
        }else {
            return redirect('admin/login')->with('error', 'Usuario ou Senha Invalida!!!');
        }
    }

    function dashboard(){
        return view('backend.dashboard');
    }
}
