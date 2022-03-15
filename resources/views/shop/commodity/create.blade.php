@extends('layouts.app')

@section('content')
    <p class="h4 mb-4 fw-bolder">新增商品</p>
    <form target="{{ route('shop.commodity.store') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control" id="name" placeholder="商品名稱" autocomplete="off" required>
            <label for="name">商品名稱</label>
        </div>
        <div class="form-floating mb-3">
            <input name="price" type="number" class="form-control" id="price" placeholder="售價" autocomplete="off" required>
            <label for="price">售價</label>
        </div>

        <div class="form-floating">
            <textarea name="description" class="form-control" placeholder="商品描述" id="description" style="height: 300px"></textarea>
            <label for="description">商品描述</label>
        </div>
        
        <a href="{{route('shop.dashboard')}}" class="btn btn-outline-secondary float-end m-2">取消</a>
        <button type="submit" class="btn btn-primary float-end m-2">建立商品</button>
    </form>
@endsection