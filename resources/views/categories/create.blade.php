@extends('layouts.app')

@section('content')
    <p class="h4 mb-4 fw-bolder">新增分類</p>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        @error('name')
            <span class="text-danger fw-bolder">{{ $message }}</span>
        @enderror
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control" id="name" placeholder="名稱" maxlength="50" autocomplete="off" value="{{ old('name') }}">
            <label for="name">名稱</label>
        </div>
        
        <a href="{{route('categories.index')}}" class="btn btn-outline-secondary float-end m-2">取消</a>
        <button type="submit" class="btn btn-primary float-end m-2">建立分類</button>
    </form>
@endsection