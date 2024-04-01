<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function showCategories2()
    {
        return view('category2');
    }
    
    public function showCategories3()
    {
        $categories = Category::all();
        return response()->json($categories);

    }

    // ****************************** store ***************************************************

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);

        $category = Category::create([
            'title' => $request->title
        ]);

        return response()->json(['success' => 'Category created successfully.']);


        // return redirect()->route('show');
    }

    // ****************************** update **********************************************

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'title2' => 'required',
        ]);

        $category->update([
            'title' => $request->title2
        ]);

        return redirect()->route('show');
    }

    // ****************************** delete **********************************************
    public function delete($id)
    {

        $category = Category::find($id);

        $category->delete();

        return redirect()->route('show');
    }
}
