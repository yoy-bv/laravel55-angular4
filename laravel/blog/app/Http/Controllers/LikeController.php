<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Response;
use App\Like;

class LikeController extends Controller
{
    public function Liked(Request $request, $post_id){
    	$user = Auth::user();
    	// check liked
    	$check = Like::where('user_id', $user->id)->where('post_id', $post_id)->first();
    	if($check) {
    		$check->delete();
    		return Response::json(['success'=> true, 'status'=> 'unlike']);
    	} else {
    		$like = new Like;
    		$like->user_id = $user->id;
    		$like->post_id = $post_id;
    		$like->save();
    		return Response::json(['success'=> true, 'status'=> 'like']);
    	}
    }
    public function getLike($post_id){
    	$user = Auth::user();
    	$arr = [];
    	$countlike = Like::where('post_id', $post_id)->count();
    	$checkuserliked = Like::where('user_id', $user->id)->where('post_id', $post_id)->first();
		$arr['total'] = $countlike;
    	if ($checkuserliked) {
			$arr['checked'] = true;
    	} 
		return Response::json(['success'=> true, 'data'=> $arr]);
    }
}
