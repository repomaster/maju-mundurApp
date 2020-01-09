<?php

use Illuminate\Database\Seeder;

use App\Reward;

class RewardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reward::truncate();

        Reward::create(['name' => 'Reward A', 'price' => 20]);
        Reward::create(['name' => 'Reward B', 'price' => 30]);
    }
}
