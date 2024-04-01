<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPosts()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('welcome', compact('posts','categories'));
        // return view('welcome', compact('categories'));
    }

    // ************************************** create post ************************************************
    public function store(Request $request)

    {
        $request->validate([
            'writer' => 'required',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required',
            'image' => 'required',
        ]);

        $path = 'images/';
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $imageName = time() . '.' . $request->image->extension();

        Post::create([
            'writer' => $request->writer,
            'body' => $request->body,
            'image' => $request->image->move($path, $imageName),
            'category_id'=>$request->category_id,

        ]);

        return redirect()->route('posts.index');
    }
    // *********************************************** update ******************************************************
    public function update(Request $request, $id)

    {
        $post = Post::find($id);
        $request->validate([
            'writer' => 'required',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required',
            'image' => 'required',
        ]);

        $path = 'images/';
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $imageName = time() . '.' . $request->image->extension();

        $post->update([
            'writer' => $request->writer,
            'body' => $request->body,
            'image' => $request->image->move($path, $imageName),
            'category_id'=>$request->category_id,

        ]);

        return redirect()->route('posts.index');
    }
    // ************************************************** delete *******************************************************
    public function delete($id)
    {

        $post = Post::find($id);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
