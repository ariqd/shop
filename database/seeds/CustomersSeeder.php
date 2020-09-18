<?php

use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Customer::create([
            'name' => 'Pembeli Retail'
        ]);

        factory(App\Customer::class, 10)->create();
    }
}
