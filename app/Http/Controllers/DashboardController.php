<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller{
    
    function index(){
        $commodities = Commodity::all();
        // $commodities = Commodity::selectRaw('*,row_number() OVER (ORDER BY id ASC) AS row_number')->skip(10)->take(3)->get();
        // $commodities = Commodity::selectRaw('*,row_number() OVER (ORDER BY id ASC) AS row_number')->offset(10)->limit(3)->get();

        // foreach($commodities as $commodity){
        //     $commodity->description = Str::limit($commodity->description,85);
        // }
        return view('shop.dashboard.index',compact('commodities'));
    }
}
