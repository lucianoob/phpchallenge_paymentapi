<?php

namespace Tests\Unit;

use App\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;


class LogTest extends TestCase
{
    public function testLogIndex()
    {
        $this->json('GET', '/api/log', [])
        	->assertResponseOk()
            ->seeJson([
            	'id' => 1,
            ]);
    }

    public function testLogShow()
    {
        $this->json('GET', '/api/log/1', [])
        	->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testLogStore()
    {
        $response = $this->json('POST', '/api/log/', 
        	[
        		'type' => 'phpunit',
        		'action' => 'test',	
        		'ip' => '127.0.0.1',	
        		'browser' => 'PHPUnit',	
        	])
        	->assertResponseStatus('201')
            ->seeJson([
                'type' => 'phpunit',
            ]);
    }

    public function testLogDelete()
    {
    	$last_log = DB::table('logs')->orderBy('id', 'DESC')->first();

        $this->json('DELETE', '/api/log/'.$last_log->id)
        ->assertResponseOk();
    }
}
