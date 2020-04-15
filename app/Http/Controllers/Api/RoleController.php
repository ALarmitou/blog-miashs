<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoleResource::collection(Role::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->validated();
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();
        if($request->has('permissions')) {
            $permissions = json_decode($request->permissions);
            foreach ($permissions as $permission) {
                $role->permissions()->attach(Permission::find($permission->id));
            }
        }
        return response()->json($role,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new RoleResource(Role::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $request->validated();
        $role = Role::find($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();
        $role->permissions()->detach();
        if($request->has('permissions')) {
            $permissions = json_decode($request->permissions);
            foreach ($permissions as $permission) {
                $role->permissions()->attach(Permission::find($permission->id));
            }
        }
        return response()->json($role,201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([],204);
    }
}
