<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try
        {
            $branch_code = generate_branch();
            $branch = new Branch();
            $branch->branch_code = $branch_code;
            $branch->name = $request->branch_name;
            $branch->system_id = $request->system_id;
            $branch->main_branch = config('app.default_branch');
            $branch->save();

            $user = new User();
            $user->branch_code = $branch_code;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            $user->sendEmailVerificationNotification();

            DB::commit();

            return response()->json([
                'message' => 'success',
                'data' => [
                    'branch' => $branch,
                    'user' => $user,
                ]
            ]);
        } catch (Exception $ex)
        {
            DB::rollBack();
            Log::error($ex);
            abort(500, 'server.error');
        }
    }
}


