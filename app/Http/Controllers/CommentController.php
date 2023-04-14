<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //$post_id = $request->post_id;
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_contents' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id; 

        $comment = Comment::create($request->all());

        //return response()->json($comment->loadMissing(['commentator']));

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'comments_contents' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only('comments_contents'));

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }
}
