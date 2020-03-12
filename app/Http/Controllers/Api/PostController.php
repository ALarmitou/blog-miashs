<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        $post = $request->all();
        $post["post_date"] = now();
        $post['user_id'] = 1;
        $post['post_status'] = 'publish';
        $post['post_type'] = 'article';
        Post::create($post);
        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new PostResource(Post::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $request->validated();
        $post = Post::find($id);
        $post->post_title = $request->get("post_title");
        $post->post_name = $request->get("post_name");
        $post->post_content = $request->get('post_content');
        $post->user_id = 2;
        $post->post_category = $request->get('post_category');
        $post->save();
        return "ok";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return "ok";
    }

    /**
     * Get all comments from a specified post
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function showComments($id){
        return response()->json(CommentResource::collection(Comment::where("post_id",$id)->get()));
    }
}
