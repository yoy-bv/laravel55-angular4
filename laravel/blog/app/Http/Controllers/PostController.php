<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth, Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_post()
    {
        $data = Post::all();
        return Response::json(['data'=> $data]);
    }
    public function getDetailPost($id)
    {
        $data = Post::find($id);
        return Response::json(['data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_posts(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $user = Auth::user();
        $post->user_id = $user->id;
        $post->author = $user->name;
        $post->active = $request->active;
        $post->content = $request->content;
        $post->save();
        return Response::json(['data' => $post]);
    }
}
