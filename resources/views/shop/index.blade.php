@extends('layouts.app')    

@section('content')
    <h4 class="fw-bold text-center mb-2">BuyGoods商店街</h4>

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
                        <a href="{{ route('shop.commodity.show',$item->id) }}" class="btn btn-primary w-100">前往購買</a>
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