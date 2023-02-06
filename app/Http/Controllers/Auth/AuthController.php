<?php

namespace App\Http\Controllers\Auth;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user()
    {
        // $menus = Menu::whereNull('parent_id')->with('children', function($q){ return $q->orderByRaw('ISNULL(ordering), ordering asc'); })->orderByRaw('ISNULL(ordering), ordering asc')->get();
        $user = auth()->user();

        // $user->menus = $menus;
        // $user->ability = [
        //     [
        //         'action' => 'manage',
        //         'subject' => 'all',
        //     ],
        // ];
        return json_data($user);
    }

    public function updateUserProfile(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        return json_data($user);
    }
    public function updatePassword(Request $request) {

        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return json_data($user);




    }
}
