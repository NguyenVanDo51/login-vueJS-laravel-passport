<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Mockery\Exception;

class CommentController extends Controller
{
    public function index()
    {
        try {
            $post = Post::query()->findOrFail(1)->first();
            return $post->comments()->get();
        } catch (Exception $exception) {

        }
    }

    public function show(Comment $comment)
    {
        return $comment;
    }
}
