<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), 403, 'Forbidden');

        $users = User::paginate(request('perpage', 15));

        return new UserCollection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('user_create'), 403, "Forbidden");
        $roles = Role::findOrFail($request->role_id);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->avatar = $request->avatar;
        $user->email_verified_at = now();
        $user->password = Hash::make('12345678');
        $user->remember_token = Str::random(10);

        if ($user->save())
        {
            $user->roles()->attach($roles);
            // $user->sendEmailVerificationNotification();
            return success();
        }

        return server_error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403, 'Forbidden');
        return json_data($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403, 'Forbidden');
        $role = DB::table('role_user')->whereUserId($user->id)->first();
        $role_id = null;
        if($role) {
            $role_id = $role->role_id;
        }
        return json_data([
            'data' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'username' => $user->username,
                'email' => $user->email,
                'role_id' => $role_id,
                'avatar' => null,
            ],
            'additional' => [
                'avatar' => $user->avatar,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $roles = Role::findOrFail($request->role_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->avatar = $request->avatar;
        $user->roles()->sync($roles);
        if ($user->save()) return success();

        return server_error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), 403, 'Forbidden');
        if ($user->delete()) return success();

        return server_error();
    }

    public function trash()
    {
        $users = User::onlyTrashed()->paginate(request('perpage', 15));

        return new UserCollection($users);
    }

}
