@extends('articles.layouts')

@section('include')
    <style>
        #content p{
            margin-bottom: 0% !important
        }
    </style>
@endsection

@section('article_body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">articles</a></li>
            <li class="breadcrumb-item active text-truncate" style="max-width: 250px;" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>

    <div class="w-100 mb-5">
        <h4 class="fw-bolder"> {{ $article->title }} </h4>
        <p class="text-muted"> {{ $article->user->name . " 於 " . $article->created_at ." 建立" }} </p>
        
        <div id="content">{!! $article->content !!}</div>
        @can('publish-articles', $article)
            <div class="d-flex justify-content-end">
                <div class="d-flex justify-content-end my-3">
                    <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-outline-dark mx-3"> 修改文章 </a>

                    @if ( !$article->deleted )
                        <form action="{{route('articles.destroy',$article->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger"> 刪除文章 </button>
                        </form>
                    @else
                        <form action="{{route('articles.reverse',$article->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-outline-success"> 回復文章 </button>
                        </form>
                    @endif
                </div>         
            </div>
        @endcan
    </div>
        
    <div class="w-100 border border-3 rounded-3">
        <div class="fb-comments" data-href="https://groulox.com/articles/{{ $article->id }}" data-width="100%" data-numposts="5" data-lazy="true"></div>
    </div>
@endsection