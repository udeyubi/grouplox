<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    function index(){
        return view('api.apitoken.index');
    }
    function generate(){
        $token = Str::random(60);
        $api_token = hash('sha256',$token);

        ApiToken::whereNotNull('id')->delete();

        ApiToken::create([
            'api_token' => $api_token
        ]);

        return redirect()->route('api.apitoken.index')->with(compact('token'));
    }
}
