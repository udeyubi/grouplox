@extends('layouts.app')

@section('name')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v13.0" nonce="6pGlG5sH"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        {{-- <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mx-3"> 商店 </a>
        <a href="{{ route('shop.dashboard') }}" class="btn btn-outline-dark mx-3"> 商店 - 儀錶板 </a> --}}
        <a href="{{ route('articles.index') }}" class="btn btn-outline-dark mx-3"> 文章 </a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-dark mx-3"> 分類 </a>
        <a href="{{ route('urlshorts.index') }}" class="btn btn-outline-dark mx-3"> 縮網址 </a>
    </div>
    <div class="w-100 text-center my-5">
        <p class="fw-bold text-muted">網站尚有功能建置中，資料隨時會清空，請勿輸入個人敏感資料</p>
        <span class="fw-bold text-muted">如需登入，可以使用帳號密碼皆為 <pre class="d-inline text-danger">admin@gmail.com</pre> 登入</span>
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection