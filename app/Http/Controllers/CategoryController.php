<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    
    function index(){
        $categories = Category::latest()->get();
        return view('categories.index',compact('categories'));
    }

    function create(){
        return view('categories.create');
    }

    function store(){
        request()->validate([
            'name' => "required|unique:categories,name"
        ]);
        Category::create([
            'name' => request()->name
        ]);

        return redirect( route('categories.index') );
    }
}
