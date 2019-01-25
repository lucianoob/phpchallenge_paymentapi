<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SystemTest extends TestCase
{
    public function testWelcome()
    {
        $this->visit('/')
             ->see('Payment API');
    }
    
    public function testWelcomeToLogin()
	{
	    $this->visit('/')
	         ->click('Login')
	         ->seePageIs('/login');
	}

    public function testWelcomeToRegister()
	{
	    $this->visit('/')
	         ->click('Register')
	         ->seePageIs('/register');
	}

    public function testLogin()
	{
	    $this->visit('/login')
	        ->type('user1@gmail.com', 'email')
	        ->type('User@1', 'password')
	        ->press('Login')
	        ->seePageIs('/home');
	}

    public function testRegister()
	{
		$password_rand = str_random(6);
	    $this->visit('/register')
	        ->type(str_random(5).' '.str_random(8), 'name')
	        ->type(str_random(10).'@gmail.com', 'email')
	        ->type($password_rand, 'password')
	        ->type($password_rand, 'password_confirmation')
	        ->type(sprintf('%03d.%03d.%03d-%02d', rand(0, 999), rand(0, 999), rand(0, 999), rand(0, 99)), 'cpf')
	        ->type(sprintf('%05d-%03d', rand(0, 99999), rand(0, 999)), 'cep')
	        ->type('Rua '.str_random(10).sprintf(', %04d', rand(0, 9999)), 'address')
	        ->type(sprintf('(%02d) %04d-%04d', rand(11, 99), rand(0, 9999), rand(0, 9999)), 'phones')
	        ->press('Next')
	        ->seePageIs('/register_checkout')
	        ->select(1, 'plan_id')
	        ->type('RONALDO COSTA SILVA', 'name_card')
	        ->type('5149 4503 0123 0078', 'number_card')
	        ->type('06/25', 'expiration')
	        ->type('111', 'ccv')
	        ->press('Checkout')
	        ->seePageIs('/login');
	}
}
