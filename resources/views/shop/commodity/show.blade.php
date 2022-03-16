@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $commodity->name }}</li>
        </ol>
    </nav>

    <div class="w-100 mb-5 min-vh-100">
        <h4 class="fw-bolder"> {{ $commodity->name }} </h4>
        
        <p>{{ $commodity->description }}</p>
        <div class="d-flex justify-content-between">
            <div class="input-group mb-3">
                <span class="input-group-text text-danger fw-bold">售價 $ {{ intval($commodity->price) }}</span>
            </div>
            <div class="input-group mb-3 w-25">
                @auth
                    <select class="form-select">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <button class="btn btn-primary" type="button">加入購物車</button>
                @else
                    <a href="{{route('login')}}" class="btn btn-outline-secondary w-100">登入後購買</a>
                @endauth
            </div>
        </div>
    </div>
        
    <div class="w-100 border border-3 rounded-3">
        <div class="fb-comments" data-href="https://groulox.com/shop/commodity/{{ $commodity->id }}" data-width="100%" data-numposts="5" data-lazy="true"></div>
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection