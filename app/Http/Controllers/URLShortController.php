<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class URLShortController extends Controller
{
    function index(){
        return view('urlshorts.index');
    }

    function store(){
        request()->validate([
            'url' => 'required|url'
        ],[
            'url.required' => '請輸入網址',
            'url.url' => '請輸入有效的網址',
        ]);
        $url = request()->url;
        $token = Env('URL_SHORTENS_TOKEN');
        $header = ['http_errors'=>false,
                    'headers'=>array('Accept'=>'application/json',
                                     'Authorization' => "Bearer $token")
                ];
        $client = new Client($header);
        $request = $client->post('https://glxs.de/api/urlshorts',['form_params' => ['url'=>$url]]);
        $response = $request->getBody()->getContents();
        return $response;
    }
}
