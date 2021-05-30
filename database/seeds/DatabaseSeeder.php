<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            ProductCategorySeeder::class,
            DiscountSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            CurrencySeeder::class,
            LocaleSeeder::class,
            PaymentMethodSeeder::class,
            DeliverySeeder::class,
            StoreSeeder::class,

        ]);
    }
}
