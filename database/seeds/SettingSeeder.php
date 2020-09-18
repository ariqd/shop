<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'target_revenue',
            'value' => 100000000,
        ]);

        Setting::create([
            'key' => 'target_products_sold',
            'value' => 200,
        ]);
    }
}
