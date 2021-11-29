<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    protected function getAll() {
        return Post::orderBy('created_at', 'desc')->get();
    }

    protected function getLatest() {
        $posts = Post::orderBy('created_at', 'desc')->take(10)->get();

        return $posts;
    }

    protected function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        switch($_FILES['image']['type']) {
            case 'image/png': $extension = '.png'; break;
            case 'image/jpeg': $extension = '.jpg'; break;

            default: return response()->json([
                'image' => ['Not the right filetype, choose .png or .jpg']
            ], 404);
        }

        $img = Image::make($request->file('image'));
        $img->fit( 500, 300);

        $path = public_path("img/posts/"); // set your own directory name there
        $filename = time().'-post'.$extension; // get your own filename here

        $img->save($path.$filename);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $filename
        ]);

        $post->save();

        return response()->json([
            'message' => 'Post created.',
        ], 201);
    }

    protected function show(Request $request, $id) {
        $post = Post::find($id);

        return response()->json($post, 201);
    }

    protected function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'body' => 'nullable',
            'image' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $post = Post::find($id);

        if(isset($_FILES['image'])) {
            switch($_FILES['image']['type']) {
                case 'image/png': $extension = '.png'; break;
                case 'image/jpeg': $extension = '.jpg'; break;

                default: return response()->json([
                    'image' => ['Not the right filetype, choose .png or .jpg']
                ], 404);
            }

            $img = Image::make($request->file('image'));
            $img->fit( 500, 300);

            $old_image = public_path('img/posts/').$post->image;
            if(file_exists($old_image)) {
                unlink($old_image);
            }

            $path = public_path("img/posts/"); // set your own directory name there
            $filename = time().'-post'.$extension; // get your own filename here

            $img->save($path.$filename);
        }

        if($post) {
            if(isset($_FILES['image'])) {
                $post->update([
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $filename
                ]);
            } else {
                $post->update([
                    'title' => $request->title,
                    'body' => $request->body
                ]);
            }

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

    protected function destroy($id) {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'message' => 'Post removed.'
        ], 201);
    }
}
