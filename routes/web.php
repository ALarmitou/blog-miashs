<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get("/",["as"=>"home",'uses'=>'HomeController@index']);

Route::get("/articles","ArticleController@index");
Route::get('/articles/{post_name}', 'ArticleController@show');

Route::get("/contact","ContactController@create");
Route::post("/contact",['as'=>'contact.store','uses'=>'ContactController@store']);

Auth::routes();
Route::get("/my-profile","UserController@profile");
Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin', ['as'=>'admin.index','uses'=>'Admin\AdminController@index']);
    Route::get('/admin/posts', ['as'=>'admin.posts.index','uses'=>'Admin\PostController@index']);
    Route::get('/admin/roles', ['as'=>'admin.roles.index','uses'=>'Admin\RoleController@index']);
    Route::get('/admin/users', ['as'=>'admin.users.index','uses'=>'Admin\UserController@index']);
});
