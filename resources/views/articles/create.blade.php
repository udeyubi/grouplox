@extends('layouts.app')

@section('include')
    <script src="https://cdn.tiny.cloud/1/p690g049wnb5s9czhsa34ywlbu9amfda9r1fociy9ovfw6rj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    <p class="h4 mb-4 fw-bolder">新增文章</p>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        @error('title')
            <span class="text-danger fw-bolder">{{ $message }}</span>
        @enderror
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="標題" maxlength="100" autocomplete="off" value="{{ old('title') }}">
            <label for="title">標題</label>
        </div>

        @error('content')
            <span class="text-danger fw-bolder">{{ $message }}</span>
        @enderror
        <div class="form-floating">
            <textarea name="content" class="form-control" placeholder="文章內容" maxlength="5000">{{ old('content') }}</textarea>
        </div>
        
        <a href="{{route('articles.index')}}" class="btn btn-outline-secondary float-end m-2">取消</a>
        <button type="submit" class="btn btn-primary float-end m-2">建立文章</button>
    </form>
@endsection

@section('scripts')
    @include('articles.tinymce_setup')
@endsection