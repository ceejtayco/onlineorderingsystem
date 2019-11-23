<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ItemsController extends Controller
{
    
    public function index() {
        $items = Item::paginate(10);
        return view('admin.items.index', compact('items'));
    }

    public function create() {
        $category = Category::all();
        return view('admin.items.create', compact('category'));
    }

    public function store(Request $request) {
        // Validate data
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'price' => 'required|numeric|between:0.00,100000.99',
            'tax' => 'required|integer|between:0,100',
            'qty' => 'required|integer|between:0,100000',
        ]);

        //FOR IMAGE
        $image = $request->file('filename');
        if(!empty($image)){
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension, File::get($image));
        }
        
        $item = new Item;
        $item->user_id = Auth::user()->id;
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->tax = $request->tax;
        $item->qty = $request->qty;
        
        if(!empty($image)){
            $item->filename = $image->getFilename().'.'.$extension;
            $item->mime = $image->getClientMimeType();
        }
        $item->save();

        return redirect('admin/manage-items');
    }
}
