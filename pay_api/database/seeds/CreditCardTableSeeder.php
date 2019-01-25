<?php

use App\CreditCard;
use Illuminate\Database\Seeder;

class CreditCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $card1 = DB::table('credit_cards')->where('id', 1)->exists();
        if(!$card1)
        {
            CreditCard::create([
                'id'    => 1,
                'name_card'    => 'RONALDO COSTA SILVA',
                'number_card'    => '5149 4503 0123 0078',
                'expiration'   =>  '06/25',
                'ccv'   =>  111,
                'is_valid'   =>  'yes',
            ]);
        }
        $card2 = DB::table('credit_cards')->where('id', 2)->exists();
        if(!$card2)
        {
            CreditCard::create([
                'id'    => 2,
                'name_card'    => 'RONALDO COSTA SILVA',
                'number_card'    => '5502 0714 3355 8213',
                'expiration'   =>  '01/21',
                'ccv'   =>  432,
                'is_valid'   =>  'no',
            ]);
        }
        $card3 = DB::table('credit_cards')->where('id', 3)->exists();
        if(!$card3)
        {
            CreditCard::create([
                'id'    => 3,
                'name_card'    => 'RONALDO COSTA SILVA',
                'number_card'    => '5814 0610 2345 7123',
                'expiration'   =>  '10/28',
                'ccv'   =>  920,
                'is_valid'   =>  'rand',
            ]);
        }
    }
}
