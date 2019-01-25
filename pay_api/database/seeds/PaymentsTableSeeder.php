<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = DB::table('payments')->where('user_id', 1)->exists();
        if(!$user1)
        {
            Payment::create([
                'id'    => 1,
                'plan_id'    => 1,
                'price'    => 100.00,
                'user_id'   =>  1,
            ]);
        }
        $user2 = DB::table('payments')->where('user_id', 2)->exists();
        if(!$user2)
        {
            Payment::create([
                'id'    => 2,
                'plan_id'    => 2,
                'price'    => 900.00,
                'user_id'   =>  2,
            ]);
        }
    }
}
