<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 101; $i++) {
            $product = [
                'product_name'          => 'Product N'. $i,
                'price'                 => 10.0,
                'description'           => 'Description N'.$i,
                'title'                 => 'Title N'.$i,
                'short_description'     => 'Short description N'.$i,
                'full_description'      => 'Full description N'.$i,
                'rating'                => 0,
                'created_at'            => now()
            ];
            \App\Product::create($product);
        }
    }
}
