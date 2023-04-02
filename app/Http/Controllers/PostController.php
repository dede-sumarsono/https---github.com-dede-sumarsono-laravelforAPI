<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Function_;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        //return response()->json($posts);  
        //return response()->json(['data' => $posts]);  
        return PostResource::collection($posts);
    }
    
    public function show($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        //return response()->json(['data'=>$post]);
        return new PostDetailResource($post);
    }

    public function show2($id)
    {
        $post = Post::findOrFail($id);
        //return response()->json(['data'=>$post]);
        return new PostDetailResource($post);
    }
}
