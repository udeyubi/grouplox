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

                <urlshortener target-route="{{ route('urlshorts.store') }}"></urlshortener>

                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 text-white bg-dark rounded-3">
                            <h2>Change the background</h2>
                            <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
                            <button class="btn btn-outline-light" type="button">Example button</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="h-100 p-5 bg-light border rounded-3">
                                <h2>Add borders</h2>
                                <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
                                <button class="btn btn-outline-secondary" type="button">Example button</button>
                            </div>
                    </div>
                </div>

                <footer class="pt-3 mt-4 text-muted border-top">
                    © GrouLox 2022
                </footer>
            </div>
        </main>
    </body>
</html>
