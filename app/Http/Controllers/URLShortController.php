<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class URLShortController extends Controller
{
    function index(){
        $cookie_histories = Cookie::get('url_history');
        // dump( $cookie_histories );
        $token = Env('URL_SHORTENS_TOKEN');
        if( !empty($cookie_histories) ){
            $header = ['http_errors'=>false,
                        'headers'=>array('Accept'=>'application/json',
                                         'Authorization' => "Bearer $token")
                    ];
            $client = new Client($header);
            $request = $client->get('https://glxs.de/api/urlshorts',['query' => ['ids' => $cookie_histories]]);
            $response = $request->getBody()->getContents();
        }

        if(isset($response)){
            $response = json_decode( $response );
            $url_histories = Arr::pluck($response,'url','id');
            $index = 0;
            foreach($url_histories as $key => $url_history){
                $url_histories[$index++] = ['id' => $key ,'url' => $url_history];
                unset($url_histories[$key]);
            }

            $result = [];

            $cookie_histories = json_decode( $cookie_histories );

            foreach($cookie_histories as $cookie_history){
                foreach( $url_histories as $url_history ){
                    if( $cookie_history == $url_history["id"] ){
                        $result[] = $url_history;
                    }
                }
            }

            $result = json_encode($result);
        }
        $url_histories = $result ?? null;

        return view('urlshorts.index',compact('url_histories'));
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
        
        if( json_decode($response)->error ){
            return $response;
        }

        $id = json_decode($response)->success->id;

        $url_history = Cookie::get('url_history');

        if(empty($url_history)){
            $url_history = [$id];
        }else{
            // Log::info( $url_history );
            $url_history = json_decode($url_history,TRUE);
            if(Arr::first($url_history) != $id){
                $url_history = Arr::prepend($url_history,$id);
                $url_history = array_unique($url_history);
            }
            // Log::info( $url_history );
        }
        $url_history = json_encode(array_values($url_history));
        Cookie::queue('url_history', $url_history);

        // Log::info( $url_history );

        return $response;
    }
}
