<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\User;
class HomepageController extends Controller
{
    public function homepage() {
        $item = Item::all();
        $category = Category::all();

        return view('homepage', compact('item', 'category'));
    }

}
