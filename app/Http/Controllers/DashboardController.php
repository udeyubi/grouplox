<?php

namespace App\Http\Controllers;

use App\Models\ApiStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $api_is_serving = ApiStatus::where('name','service')->first()->status;
        $api_need_validate = ApiStatus::where('name','validate')->first()->status;
        return view('api.dashboard.index',compact(['api_is_serving','api_need_validate']));
    }
}
