<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Function_;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); //paket b
        //return response()->json($posts);  
        //return response()->json(['data' => $posts]);  
        //$posts = Post::with('writer:id,username')->get(); paket a collection perbedaan loadmissing dan with
        //return PostDetailResource::collection($posts); paket a collection
        return PostDetailResource::collection($posts->loadMissing('writer:id,username')); //paket b

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

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);
     
        //return response()->json('Oke bisa diakses method store');

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
        
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
