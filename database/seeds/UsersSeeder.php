<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Owner',
            'email' => 'owner@atalla.com',
            'role' => 'owner',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Sales',
            'email' => 'sales@atalla.com',
            'role' => 'sales',
            'password' => Hash::make('password')
        ]);
    }
}
