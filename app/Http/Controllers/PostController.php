<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected function getAll() {
        return Post::orderBy('created_at', 'desc')->get();
    }

    protected function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable',
            'image' => 'nullable'
        ]);

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post created.',
            'data' => $post
        ], 201);
    }

    protected function show(Request $request, $id) {
        $post = Post::find($id);

        return response()->json([
            'message' => 'Post found',
            'data' => $post
        ], 201);
    }

    protected function update(Request $request, $id) {

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable',
            'image' => 'nullable'
        ]);

        $post = Post::find($id);

        if($post) {
            $post->update($data);

            return response()->json([
                'message' => 'Post updated.',
                'data' => $post
            ], 201);
        } else {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }
    }
}
