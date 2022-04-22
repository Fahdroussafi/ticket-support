<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function create()
    {
        $categories = Category::all();

        return view('categories.create');
    }

    public function store(Request $request)

    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $category = new Category([
            'name' => $request->input('name'),
        ]);

        $category->save();

        return redirect()->back()->with("status", "A category with name: $category->name has been created.");
    }
}
