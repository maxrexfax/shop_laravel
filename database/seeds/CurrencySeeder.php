<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Currency::create([
            'currency_name'              => 'Dollar',
            'currency_symbol'              => '$',
            'currency_code'       => 'USD',
            'currency_value'       => '27.54'
        ]);
        App\Currency::create([
            'currency_name'              => 'Hryvna',
            'currency_symbol'              => '₴',
            'currency_code'       => 'UAH',
            'currency_value'       => '1'
        ]);
        App\Currency::create([
        'currency_name'              => 'EURO',
        'currency_symbol'              => '€',
        'currency_code'       => 'EUR',
        'currency_value'       => '33.55'
        ]);
        App\Currency::create([
        'currency_name'              => 'Ruble',
        'currency_symbol'              => '₽',
        'currency_code'       => 'RUR',
        'currency_value'       => '0.39'
    ]);
    }
}
