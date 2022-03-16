<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    function index(){
        return 'commodity index';
    }

    function show(Commodity $commodity){
        return view('shop.commodities.show',compact('commodity'));
    }

    function create(){
        return view('shop.commodities.create');
    }

    function store(Request $request){
        Commodity::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description
        ]);

        return redirect( route('shop.dashboard') );
    }

}
