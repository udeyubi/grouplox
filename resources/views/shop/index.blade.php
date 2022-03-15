@extends('layouts.app')    

@section('content')
    <h4 class="fw-bold text-center mb-2">BuyGoods商店街</h4>

    {{-- FB 讚 SDK --}}
    <div class="w-100 d-flex justify-content-end my-3">
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fgroulox.com%2Fshop&width=1000&layout=button_count&action=like&size=small&share=true&height=46&appId" height="25" style="border:none;overflow:hidden;width:105px" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
    </div>

    <div class="row">
        @forelse ($commodity as $item)
            <div class="col-sm-6 w-25 text-center my-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->description ?? '暫無描述' }}</p>
                        <a href="{{ route('shop.commodity.show',$item->id) }}" class="btn btn-primary">{{ $item->price }}</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="font-primary"> 目前找不到任何商品... </p>
        @endforelse
    </div>
@endsection