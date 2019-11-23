<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Coupon;
use App\Order_Details;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

                $total_vat_amount += number_format($amount * $session['qty'], 2, '.', ',');
                $total_amount += number_format($price_qty, 2, '.', ',');
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
        $discount_array = [];
        if($coupon > 0) {
            $coupon_percentage = Coupon::where('code', $request->coupon)->first();
            $order->coupon_id = $coupon_percentage['id'];
            
            // Calculate discount
            $discount = $coupon_percentage['percentage']/100;
            $total_pay = number_format($total_amount - ($total_amount * $discount), 2, '.', ',');
            $order->total = $total_pay;

            array_push($discount_array,[
                'coupon' => $request->code,
                'discount' => intval($coupon_percentage['percentage']).'%',
                'totalpay' => $total_pay
            ]);
        }else{
            
            $order->total = $total_amount;
        }
        $order->save();

        // SAVE TO ORDER DETAILS
        $order_id = Order::latest('id')->first();
        
        foreach($orders as $items) {
            $order_details = new Order_Details;
            $order_details->order_id = $order_id['id'];
            $order_details->item_id = $items['item_id'];
            $order_details->qty = $items['qty'];
            $order_details->subtotal = $items['subtotal'];
            $order_details->save();

            $update_item = Item::find($items['item_id']);
            $update_item->qty = $update_item->qty - $items['qty'];
            $update_item->save();
        }

        $request->session()->forget('item');
        return view('checkout', compact('coupon','orders','total_vat_amount', 'total_amount', 'total_gross', 'discount_array'));
    }

    public function deleteItemFromSession(Request $request) {
        
        $count = 0;
        $item_session = $request->session()->get('item');
        $keys = array_keys($item_session);
        
        foreach($item_session as $item) {
            if($item['item_id'] == $request->item_id) {
                $request->session()->forget('item.'.$keys[$count]);
            }
            $count++;
        }
        
        return redirect()->route('myorders');
    }
}
