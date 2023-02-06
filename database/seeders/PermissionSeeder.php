<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'id' => 1,
                'name' => 'user_access'
            ],
            [
                'id' => 4,
                'name' => 'user_create'
            ],
            [
                'id' => 2,
                'name' => 'user_edit'
            ],
            [
                'id' => 3,
                'name' => 'user_delete'
            ],

            [
                'id' => 5,
                'name' => 'role_access'
            ],
            [
                'id' => 6,
                'name' => 'role_create'
            ],
            [
                'id' => 7,
                'name' => 'role_edit'
            ],
            [
                'id' => 8,
                'name' => 'role_delete'
            ],
            [
                'id' => 9,
                'name' => 'permission_access'
            ],
            [
                'id' => 10,
                'name' => 'permission_create'
            ],
            [
                'id' => 11,
                'name' => 'permission_edit'
            ],
            [
                'id' => 12,
                'name' => 'permission_delete'
            ],
        ];
        \App\Models\Permission::insert($data);
    }
}
