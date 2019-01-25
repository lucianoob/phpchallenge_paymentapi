<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = DB::table('plans')->where('id', 1)->exists();
        if(!$test)
        {
            Plan::create([
                'id' => 1,
                'title' => 'Montly Plan',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac auctor orci.',
                'period' => 'month',
                'price' => 100.00,
            ]);
            Plan::create([
                'id' => 2,
                'title' => 'Annual Plan',
                'description' => 'Fusce vulputate efficitur diam, ac sollicitudin felis congue a. Mauris neque augue, varius non volutpat et, sagittis nec lorem.',
                'period' => 'year',
                'price' => 900.00,
            ]);
        }
    }
}
