<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function trace($type, $action) {
        $http = new Client;
        $response = $http->post('http://nginx/api/log/', [
        'form_params' => [
            'type'    => $type,
            'action'    => $action,
        ]]);
    }
}
