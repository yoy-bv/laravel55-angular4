<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth, Response;

class CommentController extends Controller
{
    public function add_commented(Request $request, $id)
    {
    	$comment = new Comment;
        $user = Auth::user();
        $comment->author = $user->name;
        $comment->user_id = $user->id;
        $comment->post_id = $id;
    	$comment->comment = $request->comment;
    	$comment->save();
    	return Response::json(['data'=>$comment]);
    }
    public function ListCommented()
    {
    	$data = Comment::all();
    	return Response::json(['data'=>$data]);
    }
}
