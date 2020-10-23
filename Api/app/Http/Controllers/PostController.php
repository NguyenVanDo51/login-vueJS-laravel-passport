<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function create(Request $request)
    {
        return $request->all();
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function edit(Post $post)
    {
        return $post;
    }

    public function update()
    {

    }

    public function destroy(Post $post)
    {
        try {
            return $post->delete();
        } catch (\Exception $e) {
        }
    }
}
