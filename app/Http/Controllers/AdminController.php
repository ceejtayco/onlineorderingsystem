<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Order_Details;
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
        $orders = Order::all();
        $order_details = Order_Details::all();
        return view('admin.index', compact('orders', 'order_details'));
    }
}
