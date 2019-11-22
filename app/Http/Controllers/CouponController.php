<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Coupon;
class CouponController extends Controller
{
    public function index() {
        $coupon = Coupon::paginate(10);
        return view('admin.coupon.index', compact('coupon'));
    }

    public function create() {
        return view('admin.coupon.create');
    }

    public function store(Request $request) {
        // Validate data
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:coupons|max:255',
            'percentage' => 'required|integer|between:0,100',
            
        ]);

        $coupon = new Coupon;
        $coupon->user_id = Auth::user()->id;
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->code = $request->code;
        $coupon->percentage = $request->percentage;
        $coupon->save();
        return redirect('admin/manage-coupons');
    }
}
