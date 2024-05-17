<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function showSubCategories()

    {
        $categories = Category::with('posts')->get();
        return view('sub-category',compact('categories'));
    }
    // *********************************** get categories*******************************************
    public function getSubCategories()

    {
        $categories = Category::with('posts')->get();
        return response()->json($categories);
    }
}
