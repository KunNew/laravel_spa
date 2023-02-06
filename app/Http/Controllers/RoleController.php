<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleCollection;
use App\Models\Permission;
use App\Models\Role;
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
        $roles = Role::paginate(request('perpage', 15));

        return new RoleCollection($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $permissions = Permission::findOrFail($request->permissions);


        $role = new Role();

        $role->name = $request->name;



        if ($role->save()) {
            $role->permissions()->attach($permissions);
            return success();
            return server_error();
        }


        // $role->permissions()->attach($request->permissions);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return json_data($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $role;
        $datas = array();
        foreach($permissions['permissions'] as $it) {
            array_push($datas,$it['id']);
        }


        return json_data([
            'data' => [
                'name' => $role->name,
                'permissions' => $datas

            ],
            'additional' => [
                'avatar' => $role->avatar,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     *  @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $permissions = Permission::findOrFail($request->permissions);

        $role->name = $request->name;
        if($role->save()) {
            $role->permissions()->sync($permissions);
            return success();
        } else {
            return server_error();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach($role->id);
        if ($role->delete())
            return success();
        return server_error();
    }
}
