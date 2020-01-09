<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'role_id' => 1,
            'name' => 'Merchant Mania',
            'shop_name' => 'merchantShop',
            'email' => 'merchant@example.com',
            'phone' => '08123123123',
            'address' => 'Yogyakarta',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Customer Mania',
            'shop_name' => '',
            'email' => 'customer@example.com',
            'phone' => '08123123123',
            'address' => 'Yogyakarta',
            'password' => Hash::make('password'),
        ]);
    }
}
