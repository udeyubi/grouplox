<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function index(){
        $commodity = Commodity::all();
        return view('shop.index',compact('commodity'));
    }
}
