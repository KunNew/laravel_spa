<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => 'Dental Clinic Password Grant Client',
            'id' => '985d0a68-077f-4d7f-9985-3f5bd9ac7ec6',
            'secret' => 'VOGFx492fxDmWXJ6UOZnwd6sZI3CSPzeS3rO5OKi',
            'provider' => 'users',
            'redirect' => env('APP_URL'),
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
        UsersTableSeeder::class,
        PermissionSeeder::class,
        RoleSeeder::class,
        CategoriesTableSeeder::class]);
    }
}
