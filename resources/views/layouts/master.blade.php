<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpus Study Case</title>
    @include('layouts.style')
</head>

<body>
    <script src="{{ asset('mazer/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        {{--
        <div id="main" class="layout-horizontal">
            @include('layouts.header')

            <div class="content-wrapper container">
                <div class="page-content">
                    @yield('content')
                </div>

            </div>
        </div> --}}
        <div id="app">
            @include('layouts.sidebar')

            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                <div class="page-heading">
                    <h3>Perpustakaan KV</h3>
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.script')
</body>

</html>
