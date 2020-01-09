<?php

use Illuminate\Database\Seeder;

use App\PaymentOption;

class PaymentOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentOption::truncate();

        PaymentOption::create(['name' => 'BCA', 'fee' => 2000]);
        PaymentOption::create(['name' => 'Mandiri', 'fee' => 3000]);
    }
}
