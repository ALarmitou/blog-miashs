<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Permission;
use App\Post;
use App\Role;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::paginate(5));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new UserResource(User::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $request->validated();
        $user = User::find($id);
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->roles()->detach();
        $user->permissions()->detach();
        if($request->has("roles")) {
            $roles = json_decode($request->roles);
            foreach ($roles as $role) {
                $user->roles()->attach(Role::find($role->id));
            }
        }
        if($request->has("permissions")){
            $permissions = json_decode($request->permissions);
            foreach ($permissions as $permission){
                $user->permissions()->attach(Permission::find($permission->id));
            }
        }
        $user->save();
        return response()->json(new UserResource($user),201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([],204);
    }

    public function changePassword(Request $request, $id){
        request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json([],204);
    }

    /**
     * Get all posts from a specified user
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function getPosts($id){
        return response()->json(PostResource::collection(Post::where("user_id",$id)->get()));
    }


}
