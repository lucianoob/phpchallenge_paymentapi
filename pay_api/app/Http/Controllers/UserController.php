<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
{
    public function index() {
        $this->trace('user', 'index');

        return User::all();
    }
    
    public function show(User $user) {
        $this->trace('user', 'show');

        return $user;
    }

    public function store(Request $request) {
        $this->trace('user', 'store');

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user) {
        $this->trace('user', 'update');

        $user->update($request->all());
        return response()->json($user);
    }

    public function delete(User $user) {
        $this->trace('user', 'delete');

        $user->delete();
        return response()->json(null, 204);
    }
}
