<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class CategoryComposer{
    
    public function compose(View $view){
        $current_category = Request::get('c');
        if(!is_null($current_category)){
            $current_category = Category::find($current_category);
        }
        $view->with('categories', Category::all());
        $view->with('current_category', $current_category);
    }
}