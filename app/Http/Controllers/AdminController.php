<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function login() {
        if(Auth::user() && Auth::user()->type == 0){
            return redirect('admin/index');
        }else{
            return view('admin.login');
        }
        
    }

    public function validateCredentials(Request $request) {
        $username = $request->username;
        $password = $request->password;
    }

    public function index() {
        return view('admin.index');
    }
}
