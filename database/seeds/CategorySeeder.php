<?php

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
        for($i = 0; $i < 10; $i++) {
            $category = [
                'category_name'                 => 'Category N'. ($i+1),
                'created_at'            => now()
            ];
            \App\Category::create($category);
        }
    }
}
