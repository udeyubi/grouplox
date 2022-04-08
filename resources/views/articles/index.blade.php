@extends('articles.layouts')

@section('article_include')
    <meta property="og:url"                content="{{ route('articles.index') }}" />
    <meta property="og:title"              content="文章區" />
    <meta property="og:description"        content="很多很多文章" />
@endsection

@section('article_body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">articles</li>
        </ol>
    </nav>

    <div class="w-100 d-flex justify-content-between align-items-center my-3">
        {{-- 選單按鈕 --}}
        <div>
            <a class="btn border-start border-5" style="outline:none;box-shadow:none;" tabindex="-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="bi bi-journal mx-1" style="color: black"></i>分類
            </a>
            @isset( $current_category->name )
                <div class="text-center d-inline border-start border-3 border-success ps-2">
                    {{ $current_category->name }}
                </div>
            @endisset

            <div class="offcanvas offcanvas-start" style="width:15%;min-width:229px" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header border border-1 border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">選擇分類</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="list-group">
                        <a href="{{ route('articles.index') }}" class="list-group-item list-group-item-action border-0 @if(is_null(Request::get('c'))) active @endif"> 
                            全部
                        </a>
                        @isset($categories)
                            @foreach ($categories as $category)
                                <a href="{{ route('articles.index',['c'=>$category->id]) }}" class="list-group-item list-group-item-action border-0 @if(Request::get('c') == $category->id) active @endif"> 
                                    {{$category->name}} 
                                </a>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex ">
            {{-- FB 讚 SDK --}}
            <div class="fb-like" data-href="https://groulox.com/articles" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
            {{-- line 分享外嵌 --}}
            <div class="line-it-button" data-lang="zh_Hant" data-type="share-a" data-env="REAL" data-url="https://groulox.com/articles" data-color="default" data-size="small" data-count="false" data-ver="3" style="display: none;"></div>
        </div>
    </div>

    <form action="{{ route('articles.index') }}" method="GET">
        <input type="hidden" name="c" value="{{ Request::get('c') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="找點什麼嗎?" name="s" value="{{ Request::get('s') }}">
            @if ( !is_null(Request::get('s')) )
                <a class="btn-close position-absolute top-50 end-0 translate-middle" href="{{ route('articles.index') }}" title="清除搜尋"></a>
            @endif
        </div>
    </form>

    <div class="d-flex justify-content-between my-3">
        <div class="d-flex align-items-center">
            @if ( !is_null(Request::get('s')) )
                <span>
                    根據 <strong>{{ Request::get('s') }}</strong> 的搜尋結果，共 {{ $articles->total() }} 筆
                </span>
            @endif
        </div>
        <div>
            @can('publish-articles')
                <a href="{{ route('articles.create') }}" class="btn btn-primary"> 建立文章 </a>
            @endcan
        </div>
    </div>
    
    <div class="my-1 d-flex justify-content-center">
        {{ $articles->withQueryString()->links() }}
    </div>

    <div class="">
        <div class="list-group w-100">
            @forelse ($articles as $article)
                <a href="{{ route('articles.show',$article->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <span class="badge bg-secondary rounded-pill">{{ $article->category->name }}</span>
                            <p class="mb-1 d-inline fw-bold">{{$article->title}}</p>
                        </div>    
                        <small>{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="my-1 text-truncate text-black-50" style="max-width: 80%;">{{strip_tags($article->content)}}</p>
                    <small>這邊用來放TAG</small>

                    @if ( $article->deleted )
                        <span class="badge bg-danger rounded-pill float-end mx-1">已刪除</span>
                    @endif
                </a>
            @empty
                目前沒有任何文章...
            @endforelse
            
        </div>
    </div>

    <div class="my-1 d-flex justify-content-center">
        {{ $articles->withQueryString()->links() }}
    </div>
@endsection