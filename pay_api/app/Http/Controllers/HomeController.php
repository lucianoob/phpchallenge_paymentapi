<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->trace('home', 'home');

        $http = new Client;
        $payments = $http->request('GET','http://nginx/api/payment/user/'.Auth::user()->id, []);

        return view('home')->with('payments', json_decode($payments->getBody()->getContents(), true));
    }
}
