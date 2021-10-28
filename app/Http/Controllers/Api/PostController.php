<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{


    public function index()
    {

        $post = Cache::remember('cache', 20, function (){
           return Post::all();
        });
        return  PostCollection::collection($post);

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
        $post = Post::find($id);
        if(!$post){
            return [
                'message' => 'Sorry! There are no post'
            ];
        }
        else{
            return new PostResource($post);
        }
    }


    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);
        if(!$post){
            return response([
                'message' => 'Post id is not valid!'
            ]);
        }

        $post->update([
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
        $post = Post::find($id);
        if(!$post){
            return response([
                'message' => 'Sorry! Invalid post id!'
            ]);
        }
        $post->delete();
        return response([
            'message'=> 'Post deleted successfully!'
        ]);
    }
}
