<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $user = Role::create([
            'name' => 'User'
        ]);
        $admin = Role::create([
            'name' => 'Admin'
        ]);


        $permissions = Permission::all();

        $admin->permissions()->attach($permissions->pluck('id'));

        // $user->permissions()->attach($permissions->pluck('id'));

        // $user->permissions()->detach(4);

        $user->permissions()->attach([1, 5, 9]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => $user->id
            ],
            [
                'user_id' => 2,
                'role_id' => $admin->id
            ]
        ]);


    }
}
