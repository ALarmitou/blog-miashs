<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MultipleUploadRequest;
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
        $post = $request->all();
        $post["post_date"] = now();
        $post['post_status'] = 'publish';
        $post = Post::create($post);

        if($request->has('photos') && !is_null($request->photos)) {
            $photoIds = json_decode($request->photos);
            foreach ($photoIds as $photo) {
                $image = Post::find($photo);
                $image->posts()->attach($post);
            }
        }
        if($request->has('new_photos')) {
            foreach ($request->new_photos as $photo) {
                $photo->store('public');
                $imageStored = Post::create([
                    'post_name' => $photo->hashName(),
                    'post_type' => 'file',
                    'post_title' => $photo->getClientOriginalName(),
                    'post_date' => now(),
                    'post_status' => 'publish',
                    'user_id' => $request->user_id
                ]);
                $imageStored->posts()->attach($post);
            }
        }
        return response()->json($post,201);
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
        $post->post_title = $request->post_title;
        $post->post_name = $request->post_name;
        $post->post_content = $request->post_content;
        $post->post_category = $request->post_category;
        $post->save();
        $post->files()->detach();
        if($request->has('photos') && !is_null($request->photos)) {
            $photoIds = json_decode($request->photos);
            foreach ($photoIds as $photo) {
                $image = Post::find($photo);
                $image->posts()->attach($post);
            }
        }
        if($request->has('new_photos')) {
            foreach ($request->new_photos as $photo) {
                $photo->store('public');
                $imageStored = Post::create([
                    'post_name' => $photo->hashName(),
                    'post_type' => 'file',
                    'post_title' => $photo->getClientOriginalName(),
                    'post_date' => now(),
                    'post_status' => 'publish',
                    'user_id' => $request->user_id
                ]);
                $imageStored->posts()->attach($post);
            }
        }
        return response()->json($post,201);

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
        $post->files()->delete();
        $post->posts()->delete();
        $post->delete();
        return response()->json([],204);
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

    /**
     * Get all files
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function indexFiles(){
        return PostResource::collection(Post::where('post_type','file')->get());
    }


}
