<?php

use App\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Counter::create([
            'name' => 'SO',
            'counter' => '1',
            'notes' => '-',
        ]);
    }
}
