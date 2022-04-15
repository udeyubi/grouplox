<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- BootStrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        @yield("include")
    </head>
    <body>
        
        <main id="app">
            <div class="container py-4">
                <header class="pb-3 mb-2 border-bottom">
                    <a href="{{route('urlshorts.index')}}" class="d-flex align-items-center text-dark text-decoration-none">
                        <span class="fs-4">URL Shorteners</span>
                    </a>
                </header>

                {{-- <urlshortener target-route="{{ route('urlshorts.store') }}" url-histories="{{ Cookie::get('url_history') }}"></urlshortener> --}}
                <urlshortener target-route="{{ route('urlshorts.store') }}" url-histories="{{ $url_histories }}"></urlshortener>

                

                <footer class="pt-3 mt-4 text-muted border-top">
                    © GrouLox 2022
                </footer>
            </div>
        </main>
    </body>
</html>
