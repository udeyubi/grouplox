<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    const ARTICLES_PER_PAGE = 15;

    function index(){
        $is_admin = Gate::allows('publish-articles');
        $deleted_cond = $is_admin ? [0,1] : [0];
        
        $articles = Article::whereIn('deleted',$deleted_cond)->latest()->paginate(self::ARTICLES_PER_PAGE);

        return view('articles.index',compact('articles'));
    }

    function create(){
        return view('articles.create');
    }

    function store(){

        $this->article_validate();

        $article = Article::create([
            'title' => request()->title,
            'content' => request()->content,
            'user_id' => Auth::user()->id
        ]);
        return redirect( route('articles.show',$article->id) );
    }

    function show(Article $article){
        return view('articles.show',compact('article'));
    }

    function edit(Article $article){
        return view('articles.edit',compact('article'));
    }

    function update(Article $article){

        $this->article_validate();

        $article->title = request()->title;
        $article->content = request()->content;
        $article->save();

        return redirect( route('articles.show',$article->id) );
    }

    function destroy(Article $article){
        $article->deleted = 1;
        $article->deleted_at = Carbon::now();
        $article->save();

        return redirect( route('articles.index') );
    }

    function reverse(Article $article){
        $article->deleted = 0;
        $article->deleted_at = null;
        $article->save();

        return redirect( route('articles.show',$article->id) );
    }

    private function article_validate(){
        request()->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:5000',
        ]);
    }
}
