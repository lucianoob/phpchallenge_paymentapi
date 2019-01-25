<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function show($id) {
    	$this->trace('plan', 'show');

        return Plan::find($id);;
    }
}
