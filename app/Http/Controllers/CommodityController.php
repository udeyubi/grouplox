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
            'introduce'=>$request->introduce,
            'description'=>$request->description
        ]);

        return redirect( route('shop.dashboard') );
    }

    function edit(Commodity $commodity){
        return view('shop.commodities.edit',compact('commodity'));
    }

    function update(Commodity $commodity){
        $commodity->name = request()->name;
        $commodity->price = request()->price;
        $commodity->introduce = request()->introduce;
        $commodity->description = request()->description;
        $commodity->save();

        return redirect( route('shop.dashboard') );
    }

}
