<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function showCategories()

    {
        return view('category');
    }
    // *********************************** get categories*******************************************
    public function getCategories()

    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // *************************************** store ***************************************************

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);

        Category::create([
            'title' => $request->title
        ]);

        return response()->json(['success' => 'Category created successfully.']);
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

        return response()->json(['success' => 'Category updated successfully.']);
    }

    // ****************************** delete **********************************************
    public function delete($id)
    {

        $category = Category::find($id);

        $category->delete();

        return response()->json(['success' => 'Category Deleted successfully.']);
    }
}
