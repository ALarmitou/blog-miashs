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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts",['as'=>'api.posts.index','uses'=>'Api\PostController@index']);

Route::post("/posts",['as'=>'posts.store','uses'=>'Api\PostController@store'])
    ->middleware(['auth:api', 'scopes:manage-posts']);

Route::get("/posts/{id}",['as'=>'posts.show','uses'=>'Api\PostController@show']);

Route::put("/posts/{id}",['as'=>'posts.update','uses'=>'Api\PostController@update'])
    ->middleware(['auth:api', 'scopes:manage-posts']);

Route::delete("/posts/{id}",['as'=>'posts.delete','uses'=>'Api\PostController@delete'])
    ->middleware(['auth:api', 'scopes:manage-posts']);

Route::get("/posts/{id}/comments",['as'=>'posts.comments.show','uses'=>'Api\PostController@showComments']);

Route::apiResources([
    'comments'=>'Api\CommentController'
]);

Route::resource('comments', 'Api\CommentController')->names([
    'index' => 'api.comments.index'
]);


