<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class RegisterController extends Controller
{
    use RegistersUsers;


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function register(Request $request)
    {
        $data = $request->post();

        $user = DB::table('users')->where('email', $data["email"])->first();
        if(empty($user)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'cpf' => $data['cpf'],
                'cep' => $data['cep'],
                'address' => $data['address'],
                'phones' => $data['phones'],
            ]);
        }
        $http = new Client;
        $response = $http->post('http://nginx/api/payment/', [
        'form_params' => [
            'plan_id'    => $data["plan_id"],
            'price'    => $data["price"],
            'user_id'   =>  $user->id,
        ]]);

        $this->trace('register', 'register');

        session(['message' => 'Your user was created, log in system.']);

        return redirect('/login/');
    }
}
