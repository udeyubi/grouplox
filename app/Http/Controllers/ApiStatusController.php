<?php

namespace App\Http\Controllers;

use App\Models\ApiStatus;
use Illuminate\Http\Request;

class ApiStatusController extends Controller
{
    function changeStatus( $status_name ){
        $api_status = ApiStatus::where('name',$status_name)->first();
        $api_status->status = request('status');
        $api_status->save();
        
        return true;
    }
}
