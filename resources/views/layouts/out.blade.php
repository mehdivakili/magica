<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@empty($page_title)@else{{__($page_title)}} - @endempty{{ __(config('app.name', 'Laravel')) }}</title>
    <link rel="shortcut icon" href="{{url('storage/magica_m.svg')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div id="app" style="display: flex; height: 100%">

        <div class="container" style="display: flex; height: 100%">

            <div class="d-flex justify-content-center con" style="left: 0">
                <div class="magica-container ">
                    @include('svg.magica')
                    <p>{{__("The first desc1")}} <b>{{__("Free")}}</b> {{__("The first desc2")}}</p>
                    <p>{{__("The second desc")}}</p>

                </div>
                @yield('content')
            </div>
        </div>

</div>
</body>
</html>
