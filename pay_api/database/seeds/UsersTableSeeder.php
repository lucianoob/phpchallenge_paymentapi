<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = DB::table('users')->where('email', 'user1@gmail.com')->exists();
        if(!$user1)
        {
            User::create([
                'id'    => 1,
                'name'    => 'User Test 1',
                'email'    => 'user1@gmail.com',
                'password'   =>  Hash::make('User@1'),
                'cpf' =>  sprintf('%03d.%03d.%03d-%02d', rand(0, 999), rand(0, 999), rand(0, 999), rand(0, 99)),
                'phones' =>  sprintf('(%02d) %04d-%04d', rand(11, 99), rand(0, 9999), rand(0, 9999)),
                'cep' => sprintf('%05d-%03d', rand(0, 99999), rand(0, 999)),
                'address' => 'Rua '.str_random(10).sprintf(', %04d', rand(0, 9999)),
                'remember_token' =>  str_random(10),
            ]);
        }
        $user2 = DB::table('users')->where('email', 'user2@gmail.com')->exists();
        if(!$user2)
        {
            User::create([
                'id'    => 2,
                'name'    => 'User Test 2',
                'email'    => 'user2@gmail.com',
                'password'   =>  Hash::make('User@2'),
                'cpf' =>  sprintf('%03d.%03d.%03d-%02d', rand(0, 999), rand(0, 999), rand(0, 999), rand(0, 99)),
                'phones' =>  sprintf('(%02d) %04d-%04d', rand(11, 99), rand(0, 9999), rand(0, 9999)),
                'cep' => sprintf('%05d-%03d', rand(0, 99999), rand(0, 999)),
                'address' => 'Rua '.str_random(10).sprintf(', %04d', rand(0, 9999)),
                'remember_token' =>  str_random(10),
            ]);
        }
    }
}
