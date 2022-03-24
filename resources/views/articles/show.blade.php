@extends('articles.layouts')

@section('article_include')

    <meta property="og:url"                content="{{ route('articles.show',$article->id) }}" />
    <meta property="og:title"              content="{{ $article->title }}" />
    <meta property="og:description"        content="{{ strip_tags($article->content) }}" />

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

    <div class="w-100 mb-5 border-bottom border-5">
        <h4 class="fw-bolder"> {{ $article->title }} </h4>
        <div class="d-flex justify-content-between">
            <p class="text-muted"> {{ $article->user->name . " 於 " . $article->created_at ." 建立於 " . $article->category->name }} </p>
            <div class="d-flex ">
                {{-- FB 讚 SDK --}}
                <div class="fb-like" data-href="{{ route('articles.show',$article->id) }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                {{-- line 分享外嵌 --}}
                <div class="line-it-button" data-lang="zh_Hant" data-type="share-a" data-env="REAL" data-url="{{ route('articles.show',$article->id) }}" data-color="default" data-size="small" data-count="false" data-ver="3" style="display: none;"></div>
            </div>
        </div>
        
        <div id="content" class="text-break mb-3">{!! $article->content !!}</div>
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

    <div class="position-fixed bottom-0 end-0 mx-4 my-5 align-middle">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-dark rounded-circle" style="width:50px;height:50px;" title="回文章列表">
            <i class="bi bi-card-text" style="font-size: 1.5rem"></i>
        </a>
    </div>
@endsection