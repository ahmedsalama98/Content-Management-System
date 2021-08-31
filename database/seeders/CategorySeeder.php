<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([

            'title' =>'un-categories',
            'status'=>1
        ]);

        Category::create([

            'title' =>'Nature',
            'status'=>1
        ]);
        Category::create([

            'title' =>'Art',
            'status'=>1
        ]);
        Category::create([

            'title' =>'draw',
            'status'=>1
        ]);
        Category::create([

            'title' =>'singing',
            'status'=>1
        ]);
        Category::create([

            'title' =>'Dance',
            'status'=>1
        ]);
        Category::create([

            'title' =>'literature',
            'status'=>1
        ]);
        Category::create([

            'title' =>'education',
            'status'=>1
        ]);
    }
}
