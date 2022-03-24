@extends('layouts.app')

@section('include')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <meta property="fb:app_id"             content="1013649939359845">
    <meta property="og:type"               content="website" />
    <meta property="og:image"              content="{{ URL::asset('img/c628e0ac318d13760cbb76efa78d56c6.png') }}" />
    <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>

    @yield('article_include')    
@endsection

@section('content')
    @yield('article_body')
@endsection

@section('socialfooter')
    @include('layouts.footer')
@endsection