<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
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

    public function storeSessionData(Request $request) {
        $check = false;
        $data = $request->session()->all();
        foreach($data as $items) {
            if($request->item_id == session($items->item_id)) {
                $check = true;
                break;
            }
        }
        if($check) {
            echo "<script>Order is already on the cart.<script>";
        }
        $request->session()->push($request->item_id,$request->item_id);
        echo "<script>Data has been added to session<script>";
        return redirect('/');
    }

    public function accessSessionData(Request $request) {
        return $request->session()->all();
     }

     public function showQuantityForm($id) {
        $item = Item::find($id);

        return view('quantity_form')->with(compact('item'));
     }

     public function storeToSessionData(Request $request) {
        //  Validate Data
        $item = Item::find($request->id);
        $stocks = $item->qty;

        $validateData = $request->validate([
            'qty' => 'required|integer|between:1,'.$stocks,
        ]);

        // IF Validated
        $request->session()->push($request->id,$request->id);
        // echo "<script>Item successfully added to your orders.<script>";
        return redirect()->route('homepage')->withSuccess('Item successfully added to your orders.');
     }
}
