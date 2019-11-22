<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
        $category = Category::paginate(10);
        return view('admin.category.index', compact('category'));
    }

    public function create() {
        return view('admin.category.create');
    }


    public function store(Request $request) {
        // Validate data
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|min:3|max:255',
        ]);

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect('admin/manage-categories');
    }
}
