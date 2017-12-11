<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'cors'], function(){
	Route::group([
	    'middleware' => 'api',
	    'prefix' => 'auth'

	], function () {
	    Route::post('authenticate', 'AuthController@authenticate');
	});
	Route::group([
	    'middleware' => 'api',
	], function(){
	    Route::group(['middleware' => 'jwt.auth'], function(){
	    	Route::get('getuser', 'AuthController@getUser');
	    	Route::get('getusercurrent', 'AuthController@getUser');
	    	Route::get('getemployee', 'EmployeesController@GetEmployees');
	    	Route::get('get-posts', 'PostController@get_post');
	    	Route::get('get-posts/{id}', 'PostController@getDetailPost');
	    	Route::post('create-posts', 'PostController@create_posts');
	    	Route::get('listcomment', 'CommentController@ListCommented');
	    	Route::post('commented/{id}', 'CommentController@add_commented');
	    	Route::post('liked/{post_id}', 'LikeController@Liked');
	    	Route::get('getlike/{post_id}', 'LikeController@getLike');
	    });
	});
});
