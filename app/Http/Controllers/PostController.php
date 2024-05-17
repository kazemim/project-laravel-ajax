<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // ************************************** show index posts **********************************************
    public function showPosts()
    {
        $categories = Category::all();
        return view('post', compact('categories'));
    }

    // ************************************** get all posts ************************************************
    public function getPosts()
    {
        $posts = Post::with('category')->get();
        return response()->json($posts);
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
            'category_id' => $request->category_id,
        ]);

        // this return not important
        return response()->json(['success' => 'post created successfully.']);
    }
    // ***************************************** update post *******************************************
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
            'category_id' => $request->category_id,
        ]);
        // this return not important
        return response()->json(['success' => 'Post updated successfully.']);
    }
    // *************************************** delete post *****************************************
    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();
        // this return not important
        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
