<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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

                'name' => 'Foods'
            ],
            [

                'name' => 'Drink'
            ]
        ];
        \App\Models\Category::insert($data);
    }
}
