<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Store::create([
            'store_name'              => 'First store',
            'store_description'              => 'This is description of the store',
            'store_logo'       => 'header_logo.png',
            'store_keywords'       => 'Store keywords N1',
            'active'       => '1'
        ]);

        App\Store::create([
            'store_name'              => 'Second store',
            'store_description'              => 'This is description of the store 2',
            'store_logo'       => null,
            'store_keywords'       => 'Store keywords N2',
            'active'       => '0'
        ]);
    }
}
