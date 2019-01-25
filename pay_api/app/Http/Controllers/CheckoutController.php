<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\User;
use App\Payment;
use App\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register_validation(Request $request)
    {
        $user = $request->post();

        $this->trace('checkout', 'register_validation');

        if($user["password"] == $user["password_confirmation"]) {
            if(DB::table('users')->where('email', $user["email"])->exists()) {
                return array('This email is in register in system.'); 
            } else if(DB::table('users')->where('cpf', $user["cpf"])->exists()) {
                return array('This cpf is in register in system.'); 
            } else {
                return array();
            }
        } else {
            return array('Password and confirmation not equal.');
        }
    }

    public function register_checkout(Request $request)
    {
        $user = $request->post();
        $plans = Plan::get();

        $this->trace('checkout', 'register_checkout');

        return view('auth.checkout')->with('user', $user)->with('plans', $plans);
    }

    public function checkout_validation(Request $request)
    {
        $data = $request->post();

        $this->trace('checkout', 'checkout_validation');

        $card = DB::table('credit_cards')->where('number_card', $data["number_card"])->first();
        if(empty($card)) {
            return array('This credit card not exist.');
        } else {
            if($card->name_card != $data["name_card"] || $card->expiration != $data["expiration"] || $card->ccv != $data["ccv"]) {
                return array('Credit card data is invalid.');
            } else {
                $rand = rand(1, 10);
                if($card->is_valid == 'no' || ($card->is_valid == 'rand' && $rand <= 5)) {
                    return array('This credit card not is valid ('.$rand.').');
                } else if($card->is_valid == 'yes') {
                    return array();
                }
            }
        }
    }
}
