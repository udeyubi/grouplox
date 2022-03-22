@extends('articles.layouts')

@section('article_body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">articles</li>
        </ol>
    </nav>

    {{-- FB 讚 SDK --}}
    <div class="w-100 d-flex justify-content-end my-3">
        <div class="fb-like" data-href="https://groulox.com/articles" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    </div>

    <form action="{{ route('articles.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="找點什麼嗎?" name="s" value="{{ Request::get('s') }}">
            <button class="btn btn-outline-secondary" type="submit">搜尋</button>
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
        {{ $articles->links() }}
    </div>

    <div class="d-flex justify-content-end">
        <div class="list-group w-100">
            @forelse ($articles as $article)
                <a href="{{ route('articles.show',$article->id) }}" class="list-group-item list-group-item-action">
                    <span class="d-inline-block text-truncate text-primary" style="max-width: 80%;">
                        {{$article->title}}
                    </span>
                    @if ( $article->deleted )
                        <span class="badge bg-danger rounded-pill float-end mx-1">已刪除</span>
                    @endif
                    <span class="float-end text-muted mx-1"> {{ $article->created_at->diffForHumans() }} </span>
                </a>
            @empty
                目前沒有任何文章...
            @endforelse
        </div>
    </div>

    <div class="my-1 d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection