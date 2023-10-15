<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostService
{
    public function getAllPosts()
    {
        $posts = Post::all();
        return $posts;
    }

    public function createPost(array $data)
    {
        $validator = Validator::make($data, ['title' => 'required', 'content' => 'required|min:3', 'user_id' => 'required|exists:users,id',]);
        if ($validator->fails()) {
            throw new Exception('Validation Error', 422);
        }
        $post = Post::create(['title' => $data['title'], 'content' => $data['content'], 'user_id' => Auth::id(),]);
        return $post;
    }

    public function updatePost(Post $post, array $data)
    {
        $validator = Validator::make($data, ['title' => 'required', 'content' => 'required|min:3',]);
        if ($validator->fails()) {
            throw new Exception('Validation Error', 422);
        }
        $post->update(['title' => $data['title'], 'content' => $data['content'],]);
        return $post;
    }

    public function deletePost(Post $post)
    {
        $post->delete();
    }
}
