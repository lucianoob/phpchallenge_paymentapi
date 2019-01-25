<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index() {
        $this->trace('payment', 'index');
        $payments = DB::table('payments')
            ->select('payments.id', 'users.name', 'plans.title as plan', 'payments.price', 'payments.created_at as date')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->join('plans', 'plans.id', '=', 'payments.plan_id')
            ->get();
        return $payments;
    }    

    public function index_user($id) {
        $this->trace('payment', 'index_user');
        $payments = DB::table('payments')
            ->select('payments.id', 'users.name', 'plans.title as plan', 'payments.price', 'payments.created_at as date')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->join('plans', 'plans.id', '=', 'payments.plan_id')
            ->where('user_id', $id)->get();
        return $payments;
    }    

    public function show(Payment $payment) {
        $this->trace('payment', 'show');
        return $payment;
    }

    public function store(Request $request) {
        $payment = new Payment();
        $payment->plan_id = $request->get('plan_id');
        $payment->price = $request->get('price');
        $payment->user_id = $request->get('user_id');
        $payment->save();
        $this->trace('payment', 'store');
        return $payment;
    }

    public function update(Request $request, $id) {
        $payment = Payment::find($id);

        if(!$payment) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $payment->fill($request->all());
        $payment->save();

        $this->trace('payment', 'update');

        return response()->json($payment);
    }

    public function destroy($id) {
        $payment = Payment::find($id);

        if(!$payment) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $this->trace('payment', 'delete');

        $payment->delete();
    }
}
