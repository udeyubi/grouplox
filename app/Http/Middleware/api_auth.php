<?php

namespace App\Http\Middleware;

use App\Models\ApiStatus;
use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;

class api_auth{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     const ERROR_STATE = [
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Resource not found',
        503 => 'Service Unavailable'
     ];

    public function handle(Request $request, Closure $next){
        $api_isserving = ApiStatus::where('name','service')->first()->status;
        $api_validate = ApiStatus::where('name','validate')->first()->status;

        if(!$api_isserving){
            return self::getErrorContent(503);
        }

        if($api_validate){
            $token = request()->header('token');
            
            if(empty($token)){
                return self::getErrorContent(401);
            }

            $api_token = hash('sha256',$token);
            $pass_validation = ApiToken::where('api_token',$api_token)->count();

            if(!$pass_validation){
                return self::getErrorContent(403);
            }
        }

        return $next($request);
    }

    private static function getErrorContent($code){
        return response()->json(['error' => [
                                 'code' => $code,
                                 'message' => self::ERROR_STATE[$code]]],$code);
    }
}
