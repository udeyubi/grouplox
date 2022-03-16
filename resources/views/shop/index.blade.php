@extends('layouts.app')

@section('include')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </nav>
    <figure class="text-center">
        <blockquote class="blockquote">
            <h1 class="fw-bold text-center mb-2" style="font-family: 'Shadows Into Light', cursive;">BuyGoods</h1>
        </blockquote>
        <figcaption class="blockquote-footer">
            <cite title="Source Title">商店街</cite>
        </figcaption>
    </figure>
    

    {{-- FB 讚 SDK --}}
    <div class="w-100 d-flex justify-content-end my-3">
        <div class="fb-like" data-href="https://groulox.com/shop" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
    </div>

    <div class="row">
        @forelse ($commodity as $item)
            <div class="col-sm-6 w-25 my-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder">{{ $item->name }}</h5>
                        <span class="card-text w-100 overflow-hidden mt-3 mb-2" style="text-overflow:clip;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;" title="{{ $item->description }}">{{ $item->description ?? '暫無描述..' }}</span>
                        <p class="card-text fw-bold text-danger">$ {{ intval($item->price) }}</p>
                        <a href="{{ route('shop.commodities.show',$item->id) }}" class="btn btn-primary w-100">前往購買</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="font-primary"> 目前找不到任何商品... </p>
        @endforelse
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection