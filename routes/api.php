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

Route::get("/posts",['as'=>'api.posts.index','uses'=>'Api\PostController@index']);

Route::post("/posts",['as'=>'posts.store','uses'=>'Api\PostController@store'])
    ->middleware(['auth:api', 'scope:create-posts,manage-posts']);

Route::get("/posts/{id}",['as'=>'posts.show','uses'=>'Api\PostController@show']);

Route::put("/posts/{id}",['as'=>'posts.update','uses'=>'Api\PostController@update'])
    ->middleware(['auth:api']);

Route::delete("/posts/{id}",['as'=>'posts.delete','uses'=>'Api\PostController@destroy'])
    ->middleware(['auth:api', 'scopes:manage-posts']);

Route::get("/posts/{id}/comments",['as'=>'posts.comments.show','uses'=>'Api\PostController@showComments']);

Route::get("/front/posts",['as'=>'posts.front.index','uses'=>'Api\PostController@indexFront']);

Route::get("/posts/category/{category}",['as'=>'posts.categories.index','uses'=>'Api\PostController@getByCategory']);

Route::get("/posts/all/categories",['as'=>'posts.categories.all','uses'=>'Api\PostController@allCategories']);

Route::get("/files",['as'=>'posts.files.index','uses'=>'Api\PostController@indexFiles']);


Route::apiResources([
    'comments'=>'Api\CommentController'
]);


Route::get("/roles/all",['as'=>'roles.all','uses'=>'Api\RoleController@all'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::get("/roles",['as'=>'roles.index','uses'=>'Api\RoleController@index'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::post("/roles",['as'=>'roles.store','uses'=>'Api\RoleController@store'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::get("/roles/{id}",['as'=>'roles.show','uses'=>'Api\RoleController@show'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::put("/roles/{id}",['as'=>'roles.update','uses'=>'Api\RoleController@update'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::delete("/roles/{id}",['as'=>'roles.delete','uses'=>'Api\RoleController@destroy'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::get("/permissions",['as'=>'permissions.index','uses'=>'Api\PermissionController@index'])
    ->middleware(['auth:api', 'scopes:manage-roles']);

Route::get("/users",['as'=>'users.index','uses'=>'Api\UserController@index'])
    ->middleware(['auth:api', 'scopes:manage-users']);

Route::get("/users/{id}",['as'=>'users.show','uses'=>'Api\UserController@show'])
    ->middleware(['auth:api', 'scopes:manage-users']);

Route::put("/users/{id}",['as'=>'users.update','uses'=>'Api\UserController@update'])
    ->middleware(['auth:api']);

Route::delete("/users/{id}",['as'=>'roles.delete','uses'=>'Api\UserController@destroy'])
    ->middleware(['auth:api', 'scopes:manage-users']);

Route::put("/users/{id}/password",['as'=>'users.change.password','uses'=>'Api\UserController@changePassword'])
    ->middleware(['auth:api']);

Route::get("/users/{id}/posts",['as'=>'user.posts.show','uses'=>'Api\UserController@getPosts']);



Route::get("/admin-menu",['as'=>'admin.menu','uses'=>'Api\AdminController@index'])
    ->middleware(['auth:api', 'scopes:manage-users,manage-posts,manage-roles']);


Route::resource('comments', 'Api\CommentController')->names([
    'index' => 'api.comments.index'
]);
