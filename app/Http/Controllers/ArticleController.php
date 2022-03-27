<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    const ARTICLES_PER_PAGE = 15;

    function index(){

        // DB::enableQueryLog();
        $search = trim(request()->s);
        $search_category_id = trim(request()->c);

        $is_admin = Gate::allows('publish-articles');


        $articles = Article::whereRaw('1=1');

        if(!$is_admin){
            $articles = $articles->where('deleted',0);
        }

        if(hasSet($search)){
            $articles = search($articles,$search);
        }

        if(hasSet($search_category_id)){
            $articles = $articles->where('category_id',$search_category_id);
        }

        $articles = $articles->latest('id')->paginate(self::ARTICLES_PER_PAGE)->withQueryString();

        // dump(DB::getQueryLog());

        return view('articles.index',compact('articles'));
    }

    function create(){
        return view('articles.create');
    }

    function store(){

        article_validate();

        $article = Article::create([
            'title' => request()->title,
            'content' => request()->content,
            'user_id' => Auth::user()->id,
            'category_id' => request()->category_id,
        ]);

        setFlashMsg('文章已成功建立');

        return redirect( route('articles.show',$article->id) );
    }

    function show(Article $article){
        return view('articles.show',compact('article'));
    }

    function edit(Article $article){
        return view('articles.edit',compact('article'));
    }

    function update(Article $article){

        article_validate();

        $article->title = request()->title;
        $article->content = request()->content;
        $article->category_id = request()->category_id;
        $article->save();

        setFlashMsg('文章已修改');

        return redirect( route('articles.show',$article->id) );
    }

    function destroy(Article $article){
        $article->deleted = 1;
        $article->deleted_at = Carbon::now();
        $article->save();

        setFlashMsg('文章已刪除');
        return redirect( route('articles.index') );
    }

    function reverse(Article $article){
        $article->deleted = 0;
        $article->deleted_at = null;
        $article->save();

        setFlashMsg('文章已回復');
        return redirect( route('articles.show',$article->id) );
    }

    
}

function article_validate(){
    request()->validate([
        'title' => 'required|max:100',
        'content' => 'required|max:65535',
        'category_id' => 'required|exists:categories,id'
    ]);
}

function search($query,$search){
    return $query->where('title','LIKE',"%$search%");
}

function hasSet($value){
    return (!is_null($value) && $value != '');
}

function setFlashMsg($msg){
    request()->session()->flash('successMsg',$msg);
}
