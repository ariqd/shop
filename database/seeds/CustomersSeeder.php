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
        $user = App\User::create([
            'name' => 'Pembeli Retail',
            'role' => 'customer'
        ]);

        App\Customer::create([
            'user_id' => $user->id,
            'address' => null,
            'province_id' => 9,
            'province_name' => 'Jawa Barat',
            'city_id' => 23,
            'city_name' => 'Bandung',
            'phone' => null,
            'status' => 'Customer',
        ]);
    }
}
