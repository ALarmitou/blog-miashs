<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ArticleController extends Controller
{
    public function index(){
        return view("articles");
    }

    public function show($name){
        $post = Post::where("post_name",$name)->first();
        return view("posts/single",array("post"=>$post));
    }
}
