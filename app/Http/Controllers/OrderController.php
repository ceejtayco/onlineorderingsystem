<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Coupon;
use App\Order_Details;
use App\Order;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function index(Request $request) {
        $sessions = $request->session()->all();
        $myorders = [];
        foreach($sessions as $session) {
            $item = Item::find($session);
            $myorders->push('name',$item->name);
            $myorders->push('description',$item->name);
            $myorders->push('name',$item->name);
            $myorders->push('name',$item->name);
        }
        return view('myorders');
    }

    public function accessSessionData(Request $request) {
        return $request->session()->all();
     }

     public function showQuantityForm($id) {
        $item = Item::find($id);
        $gross=[];
        // Calculate gross price
        $tax = $item->tax/100+1;
        $price = $item->price;
        $gross = number_format($price/$tax,2,'.',',');
        $amount = number_format($price - ($price/$tax),2,'.',',');

        return view('quantity_form')->with(compact('item','gross','amount'));
     }

     public function storeToSessionData(Request $request) {
        //  Validate Data
        $item = Item::find($request->id);
        $stocks = $item->qty;

        $validateData = $request->validate([
            'qty' => 'required|integer|between:1,'.$stocks,
        ]);

        // IF Validated
        $request->session()->push('item',[
            'item_id' => $request->id,
            'qty' => $request->qty
        ]);
        // echo "<script>Item successfully added to your orders.<script>";
        return redirect()->route('homepage')->withSuccess('Item successfully added to your orders.');
     }

     public function showMyOrders(Request $request) {
        $item_session = $request->session()->get('item');
        $orders = [];
        $total_vat_amount = 0;
        $total_amount = 0;
        $total_gross = 0;
        if(!empty($item_session)) {
            
            foreach($item_session as $session) {
                $item = Item::find($session['item_id']);


                // Calculate gross price
                $tax = $item->tax/100+1;
                $price = number_format($item->price,2,'.',',');
                $gross = number_format($price/$tax,2,'.',',');
                $amount = number_format($price - ($price/$tax),2,'.',',');
                $price_qty = number_format($price * $session['qty'],2,'.',',');

                $total_vat_amount += $amount * $session['qty'];
                $total_amount += $price_qty;
                $total_gross += $gross * $session['qty'];
                
                

                
                array_push($orders, [
                    'item_id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category->name,
                    'price' => $item->price,
                    'filename' => $item->filename,
                    'qty' => $session['qty'],
                    'vat_amount' => $amount,
                    'subtotal' => $price_qty,
                ]);
            }
        }

    return view('myorders', compact('orders','total_vat_amount', 'total_amount', 'total_gross'));
     }

    public function checkOut(Request $request) {
        // VALIDATE DATA
        $coupon=0;
        if(!empty($request->coupon)){
            $coupon = Coupon::where('code', $request->coupon)->count();
            
            $validateData = $request->validate([
                'coupon' => 'exists:coupons,code',
            ]);
        }


        $item_session = $request->session()->get('item');
        $orders = [];
        $total_vat_amount = 0;
        $total_amount = 0;
        $total_gross = 0;
        if(!empty($item_session)) {
            
            foreach($item_session as $session) {
                $item = Item::find($session['item_id']);


                // Calculate gross price
                $tax = $item->tax/100+1;
                $price = number_format($item->price,2,'.',',');
                $gross = number_format($price/$tax,2,'.',',');
                $amount = number_format($price - ($price/$tax),2,'.',',');
                $price_qty = number_format($price * $session['qty'],2,'.',',');

                $total_vat_amount += $amount * $session['qty'];
                $total_amount += $price_qty;
                $total_gross += $gross * $session['qty'];
                
                

                
                array_push($orders, [
                    'item_id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category->name,
                    'price' => $item->price,
                    'filename' => $item->filename,
                    'qty' => $session['qty'],
                    'vat_amount' => $amount,
                    'subtotal' => $price_qty,
                ]);
            }
        }

        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->subtotal = $total_gross;
        $order->totaltax = $total_vat_amount;
        if($coupon > 0) {
            
        }
        
        return view('checkout', compact('coupon'));
    }

    public function deleteFunction(Request $request) {

    }
}
