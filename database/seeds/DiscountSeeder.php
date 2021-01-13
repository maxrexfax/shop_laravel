<?php

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            [
                'discount_name'                 => 'Discount N 1',
                'discount'              => 10.1,
                'created_at'            => now()
            ],
            [
                'discount_name'                 => 'Discount N 21',
                'discount'              => 20.2,
                'created_at'            => now()
            ],
        ]);
    }
}
