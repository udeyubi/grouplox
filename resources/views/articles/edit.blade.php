@extends('layouts.app')

@section('include')
    <script src="https://cdn.tiny.cloud/1/p690g049wnb5s9czhsa34ywlbu9amfda9r1fociy9ovfw6rj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    <p class="h4 mb-4 fw-bolder">修改文章</p>
    <form action="{{ route('articles.update',$article->id) }}" method="POST">
        @csrf
        @method('put')

        @error('title')
            <span class="text-danger fw-bolder">{{ $message }}</span>
        @enderror
        @error('category_id')
            <span class="text-danger fw-bolder">{{ $message }}</span>
        @enderror

        <div class="input-group mb-3">
            <input name="title" type="text" class="form-control w-75" id="title" placeholder="標題" maxlength="100" autocomplete="off" required value="{{ $article->title }}">

            <select class="form-select" name="category_id">
                <option value="" selected>請選擇分類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($article->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        @error('content')
            <span class="text-danger fw-bolder">文章內容不可空白</span>
        @enderror
        <div class="form-floating">
            <textarea name="content" class="form-control" placeholder="文章內容" maxlength="5000" id="content" style="height: 300px">{{ $article->content }}</textarea>
        </div>
        
        <a href="{{route('articles.index')}}" class="btn btn-outline-secondary float-end m-2">取消</a>
        <button type="submit" class="btn btn-primary float-end m-2">確定變更</button>
    </form>
@endsection

@section('scripts')
    @include('articles.tinymce_setup')
@endsection