<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return  PostCollection::collection(Post::all());

    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        Post::create([
            'user_id' => 3,
            'title' => $validate['title'],
            'slug' => $validate['slug'],
            'excerpt' => $validate['excerpt'],
            'body' => $validate['body'],
        ]);

        return response([
            'message' => 'Post created successfully!'
        ], 200);


    }


    public function show($id)
    {
        return new PostResource(Post::find($id));
    }


    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        Post::where('id', $id)->update([
            'user_id' => 1,
            'title' => $validate['title'],
            'slug' => $validate['slug'],
            'excerpt' => $validate['excerpt'],
            'body' => $validate['body'],
        ]);

        return response([
            'message' => 'Post updated successfully!'
        ], 201);

    }


    public function destroy($id)
    {
        Post::find($id)->delete();
        return response([
            'message'=> 'Post deleted successfully!'
        ]);
    }
}
