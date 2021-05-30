<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Delivery::create([
            'delivery_name'              => 'Nova Pochta',
            'delivery_description'              => 'Cool and fine thing',
            'delivery_price'       => '5',
            'active'       => '1'
        ]);
        App\Delivery::create([
            'delivery_name'              => 'Nova Pochta 2',
            'delivery_description'              => 'Cool and fine thing 2',
            'delivery_price'       => '10',
            'active'       => '1'
        ]);
    }
}
