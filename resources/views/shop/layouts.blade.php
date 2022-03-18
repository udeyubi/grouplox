@extends('layouts.app')

@section('include')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <meta property="og:url"           content="https://groulox.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="https://static.xx.fbcdn.net/rsrc.php/v3/yb/r/-Hn0KbzDJps.png" />
@endsection

@section('content')
    @yield('shop_body')
    
    <!--購物車按鈕-->
    <div class="btn btn-outline-primary position-fixed end-0 bottom-0 translate-middle rounded-circle" style="width:55px;height:55px">
        <i class="bi bi-cart position-absolute top-50 start-50 translate-middle" style="font-size: 2rem;"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">12</span>
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection