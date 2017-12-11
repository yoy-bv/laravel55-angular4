<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckToken;
use Validator;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    /**
     * Authenticate an user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    'code' => 1,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
        }

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['code' => 2, 'message' => 'Invalid credentials.'], 401);
        }
    }

    /**
     * Get the user by token.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request)
    {
        // JWTAuth::setToken($request->input('token'));
        $user = JWTAuth::toUser();
        return response()->json($user);
    }
    public function getUserCurrent(Request $request)
    {
        // JWTAuth::setToken($request->input('token'));
        $user = Auth::user();
        return response()->json($user);
     //    try{
     //    if(! $user = JWTAuth::parseToken()->authenticate()){
     //        return response()->json(['user_not_found'], 404);
	    //     }
	    // }
	    // catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
	    //     return response()->json(['token_expired'], $e->getStatusCode());
	    // }
	    // catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
	    //     return response()->json(['token_invalid'], $e->getStatusCode());
	    // }
	    // catch(Tymon\JWTAuth\Exceptions\JWTException $e){
	    //     return response()->json(['token_absent'], $e->getStatusCode());
	    // }

	    // return response()->json(compact('user'));
    }
}