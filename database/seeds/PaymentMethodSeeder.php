<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentMethod::create([
            'payment_method_name'              => 'Credit card',
            'other_data'              => 'Some data',
            'payment_method_code'       => 'credit',
            'logo'       => 'visamcard.jpg'
        ]);
        App\PaymentMethod::create([
            'payment_method_name'              => 'Paypal',
            'other_data'              => 'Tratata',
            'payment_method_code'       => 'paypal',
            'logo'       => 'pp.jpg'
        ]);
        App\PaymentMethod::create([
            'payment_method_name'              => 'Cash',
            'other_data'              => 'Money money',
            'payment_method_code'       => 'cash',
            'logo'       => 'cash-money-icon.jpg'
        ]);
    }
}
