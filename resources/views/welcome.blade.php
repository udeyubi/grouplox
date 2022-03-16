@extends('layouts.app')

@section('name')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v13.0" nonce="6pGlG5sH"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mx-3"> 商店 </a>
        <a href="{{ route('shop.dashboard') }}" class="btn btn-outline-dark mx-3"> 商店 - 儀錶板 </a>
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection