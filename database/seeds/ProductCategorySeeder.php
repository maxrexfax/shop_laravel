<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1;
        for ($catId = 1; $catId < 11; $catId++) {
            for ($j = 0; $j < 10; $j++){
                App\CategoryProduct::create([
                    'product_id'              => $count,
                    'category_id'              => $catId
                ]);
                $count++;
            }
        }
    }
}
