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
</head>
<body>
<div id="app">
    @include('admin.layouts.top-nav')

    <main class="py-0">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">
                    Admin Dashboard
                </h2>
            </div>
            <div class="card-body p-0 m-0">
                <div class="row">
                    <div class="col-sm-3">
                        @include('admin.layouts.side-nav')
                    </div>
                    <div class="col-sm-9">
                        <div class="pr-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
