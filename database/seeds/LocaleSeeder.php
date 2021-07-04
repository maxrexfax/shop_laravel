<?php

use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Locale::create([
            'locale_name'              => 'English',
            'locale_code'              => 'en',
            'locale_logo'       => 'locale_usa.png'
        ]);
        App\Locale::create([
            'locale_name'              => 'Ukraine',
            'locale_code'              => 'ua',
            'locale_logo'       => 'locale_ukr.png'
        ]);
        App\Locale::create([
            'locale_name'              => 'Русский',
            'locale_code'              => 'ru',
            'locale_logo'       => 'locale_ru.png'
        ]);
    }
}
