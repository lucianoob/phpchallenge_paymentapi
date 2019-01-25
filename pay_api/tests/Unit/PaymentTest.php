<?php

namespace Tests\Unit;

use App\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PaymentTest extends TestCase
{

    public function testPaymentIndex()
    {
        $this->json('GET', '/api/payment', [])
        	->assertResponseOk()
            ->seeJson([
            	'id' => 1,
            ]);
    }

    public function testPaymentIndexUser()
    {
        $this->json('GET', '/api/payment/user/1', [])
        	->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testPaymentShow()
    {
        $this->json('GET', '/api/payment/1', [])
        	->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testPaymentStore()
    {

        $response = $this->json('POST', '/api/payment/', 
        	[
        		'plan_id' => 1,	
        		'price' => '100',	
        		'user_id' => 1,	
        	])
        	->assertResponseStatus('201')
            ->seeJson([
                'user_id' => 1,
            ]);
    }

    public function testPaymentUpdate()
    {
    	$last_payment = DB::table('payments')->where('user_id', '1')->orderBy('id', 'DESC')->first();

        $this->json('PUT', '/api/payment/'.$last_payment->id, 
        	[
        		'plan_id' => 1,	
        		'price' => '300',	
        		'user_id' => 1,	
        	])
        ->assertResponseOk();
    }

    public function testPaymentDelete()
    {
    	$last_payment = DB::table('payments')->where('user_id', '1')->orderBy('id', 'DESC')->first();

        $this->json('DELETE', '/api/payment/'.$last_payment->id)
        ->assertResponseOk();
    }
}
