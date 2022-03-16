@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mx-3"> 商店 </a>
        <a href="{{ route('shop.dashboard') }}" class="btn btn-outline-dark mx-3"> 商店 - 儀錶板 </a>
    </div>
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection