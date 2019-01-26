<?php

use App\Log;
use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $log1 = DB::table('logs')->where('id', 1)->exists();
        if(!$log1)
        {
            Log::create([
                'id'    => 1,
                'type'    => 'laravel',
                'action'    => 'test1',
                'ip'   =>  '127.0.0.1',
                'browser'   =>  'laravel',
                'date'   =>  date("Y-m-d H:i:s"),
            ]);
        }
        $log2 = DB::table('logs')->where('id', 2)->exists();
        if(!$log2)
        {
            Log::create([
                'id'    => 2,
                'type'    => 'laravel',
                'action'    => 'test2',
                'ip'   =>  '127.0.0.1',
                'browser'   =>  'laravel',
                'date'   =>  date("Y-m-d H:i:s"),
            ]);
        }
        $log3 = DB::table('logs')->where('id', 3)->exists();
        if(!$log3)
        {
            Log::create([
                'id'    => 3,
                'type'    => 'laravel',
                'action'    => 'test3',
                'ip'   =>  '127.0.0.1',
                'browser'   =>  'laravel',
                'date'   =>  date("Y-m-d H:i:s"),
            ]);
        }
    }
}
