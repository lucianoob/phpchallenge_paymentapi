<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;


class LogController extends Controller
{
    public function index() {
        return Log::all();
    }
    
    public function show(Log $log) {
        return $log;
    }
    public function store(Request $request) {
        $log = new Log();
        $log->type = $request->get('type');
        $log->action = $request->get('action');
        $log->ip = (empty($request->get('ip')) ? $this->getIP() : $request->get('ip'));
        $log->browser = (empty($request->get('browser')) ? $_SERVER['HTTP_USER_AGENT'] : $request->get('browser'));
        $log->date = date("Y-m-d H:i:s");
        $log->save();
        return $log;
    }

    public function destroy($id) {
        $log = Log::find($id);

        if(!$log) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $log->delete();
    }

    protected function getIP() {
    	$ip = "";
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
    }
}
