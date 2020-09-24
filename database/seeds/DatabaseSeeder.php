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
        $this->call(UsersSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CounterSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CustomersSeeder::class);
        // $this->call(ProductsSeeder::class);
        // $this->call(PurchasesSeeder::class);
    }
}
