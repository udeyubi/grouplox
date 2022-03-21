@extends('layouts.app')

@section('content')
    <p class="h4 mb-4 fw-bolder">修改文章</p>
    <form action="{{ route('articles.update',$article->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="標題" maxlength="100" autocomplete="off" required value="{{ $article->title }}">
            <label for="title">標題</label>
        </div>

        <div class="form-floating">
            <textarea name="content" class="form-control" placeholder="文章內容" maxlength="5000" id="content" style="height: 300px">{{ $article->content }}</textarea>
            <label for="content">文章內容</label>
        </div>
        
        <a href="{{route('articles.index')}}" class="btn btn-outline-secondary float-end m-2">取消</a>
        <button type="submit" class="btn btn-primary float-end m-2">確定變更</button>
    </form>
@endsection