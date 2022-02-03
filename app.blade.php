<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>

    @empty($js)
    @else
        @foreach($js as $j)
            <script src="{{ asset('js/'.$j.'.js') }}" defer></script>
        @endforeach
    @endempty
    <script>
        var res = []

        function toRes(c, h, px, ul_px = 20) {
            res.push({source: c, dest: h, px: px, ul_px: ul_px})
        }
    </script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body class="body ">
<div id="panel-app" class="panel">






    <div class="panel-menu-holder" style=" min-width: 200px; margin:18px 0 18px 18px;"></div>
    <div class="panel-menu style-div" style="overflow: hidden; position: absolute;top: 18px; height: calc(100% - 36px); min-height: 700px">

        <div class="style-div" style="margin: -20px; padding: 0; height: 150%;">
            <div class="magica-container"><a href="{{route('home')}}">@include('svg.magica-gradient')</a></div>
            <ul class="items">
                <li class="item row">
                    <div class="icon">@include('svg.home')</div>
                    <a href="{{url('home')}}">{{__('home')}}</a></li>
                <li class="item row">
                    <div class="icon">@include('svg.design')</div>
                    <a href="{{route('arts')}}">{{__('create order')}}</a></li>
                <li class="item row">
                    <div class="icon">@include('svg.pencil')</div>
                    <a href="{{route('editpictures')}}">{{__('edit pictures')}}</a></li>
                {{--                <li class="item row"><div class="icon">@include('svg.speaker')</div><a href="{{url('yourAds')}}">{{__('your ads')}}</a></li>--}}
{{--                <li class="item row">
                    <div class="icon">@include('svg.star')</div>
                    <a href="{{url('upgradeAccount')}}">{{__('upgrade account')}}</a></li>--}}
                <li class="item row">
                    <div class="icon">@include('svg.bookmark')</div>
                    <a href="{{url('savedOrders')}}">{{__('saved orders')}}</a></li>
                <li class="item row">
                    <div class="icon">@include('svg.mail')</div>
                    <a href="{{url('tickets')}}">{{__('tickets')}}</a></li>
                <li class="item row">
                    <div class="icon">@include('svg.info-black')</div>
                    <a href="{{url('aboutus')}}">{{__('About us')}}</a></li>
                <li class="item row">
                    <div class="icon">@include('svg.exit')</div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </ul>
            <div class="user-info justify-content-center">
                <p >{{\Auth::user()->name}}</p>
                <button class="btn btn-gradient" data-toggle="modal"
                        data-target="#editUserModal">{{__('Edit information')}}</button>

            </div>
        </div>

    </div>
    <div class="content style-div">
        <div class="nav-mobile style-div justify-content-between">
            <button class="bar-btn">
                <i class="menubar">@include('svg.menubar')</i>
                <i class="exit" style="display: none">@include('svg.cancel')</i>
            </button>
            <div class="magica-container"><a href="{{route('home')}}">@include('svg.magica_delta2')</a></div>
            <a class="upgrade-account" href="{{url('upgradeAccount')}}">@include('svg.star2') </a>
        </div>

        <form method="get" action="{{url('search')}}" class="panel-menu-mobile style-div">
            <div class="magica-con"><a href="{{route('home')}}">@include('svg.magica_delta2')</a>
                <button type="submit" style="background: none; border: none; outline: 0" class="magnifier-con">
                    @include('svg.magnifier2')
                </button>
            </div>
            <div class="search-bar-mobile">

                <input type="text" name="s" placeholder="{{__('Search')}}" value="{{request('s')}}" class="search-bar">
            </div>

            <ul class="items">
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.home')</div>
                    <a href="{{url('home')}}">{{__('home')}}</a></li>
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.design')</div>
                    <a href="{{route('arts')}}">{{__('create order')}}</a></li>
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.pencil')</div>
                    <a href="{{route('editpictures')}}">{{__('edit pictures')}}</a></li>
{{--                                <li class="item d-flex flex-row-reverse justify-content-between"><div class="icon">@include('svg.speaker')</div><a href="{{url('yourAds')}}">{{__('your ads')}}</a></li>--}}
{{--                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.star')</div>
                    <a href="{{url('upgradeAccount')}}">{{__('upgrade account')}}</a></li>--}}
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.bookmark')</div>
                    <a href="{{url('savedOrders')}}">{{__('saved orders')}}</a></li>
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.mail')</div>
                    <a href="{{url('tickets')}}">{{__('tickets')}}</a></li>
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.info-black')</div>
                    <a href="{{url('aboutus')}}">{{__('About us')}}</a></li>
                <li class="item d-flex flex-row-reverse justify-content-between">
                    <div class="icon">@include('svg.exit')</div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
            </ul>
            <div class="user-info justify-content-end">
                <p class="text-center">{{\Auth::user()->name}}</p>
                <button type="button" class="btn btn-gradient" data-toggle="modal"
                        data-target="#editUserModal">{{__('Edit information')}}</button>

            </div>
        </form>

        <form method="get" action="{{url('search')}}" class="nav style-div justify-content-between">
            <button type="submit" style="" class="magnifier-con">
                @include('svg.magnifier')
            </button>

            <input type="text" name="s" value="{{request('s')}}" placeholder="{{__('Search')}}" class="search-bar">
            <div class="magica-delta-container"><a href="{{route('home')}}">@include('svg.magica_delta')</a></div>

        </form>





        <main class="@if($available ?? false) available @endif" style="min-height: {{$min_height??'auto'}}">@yield('content')</main>

    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@if(Session::has('message'))
    <script>

        $(document).ready(function () {
            Swal.fire({
                icon: '{{Session::get('alert-class', 'alert-info')}}',
                title: '{{Session::get('message')}}',
                confirmButtonText: `{{__("OK")}}`,
                //text: 'Something went wrong!'
            })
        })


    </script>



@endif
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
     aria-labelledby="editUserModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content style-div">
            <div class="style-div-extra-20">
                <div class="modal-body">
                    <form action="editUser" method="post">
                        @csrf
                        <p class="title">{{__("Edit user information")}}</p>
                        <div class="form-group d-flex flex-nowrap">
                            <input style="margin-left: 1.1rem" class="form-control" type="text" name="name" placeholder="{{__("Name")}}"
                                   value="{{Auth::user()->name}}">
{{--                            <input class="form-control" type="number" name="phone_number"--}}
{{--                                   value="{{Auth::user()->phone_number}}" placeholder="{{__('Phone number')}}">--}}

                            <input class="form-control" type="email" name="email"
                                   value="{{Auth::user()->email ?? ""}}" placeholder="{{__("E-Mail Address")}}"
                                   autocomplete="email">
                        </div>
                        <div class="form-group d-flex flex-nowrap">

                            <input style="margin-left: 1.1rem"  class="form-control" type="password" name="password"
                                   placeholder="{{__("Password")}}"
                                   autocomplete="password">
                            <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                        </div>

                        <div class="form-group d-flex justify-content-end" style="margin-bottom: 0">
                            <button class="btn" style="margin-left: 1.1rem" data-dismiss="modal">{{__("Cancel")}}</button>
                            <button class="btn" type="submit">{{__("Save")}}</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function bookmark(url, e) {
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                if (data === "added successfully") {
                    $(e).html(`@include("svg.bookmark-fill")`);
                } else {
                    $(e).html(`@include("svg.bookmark-white")`);
                }

            }
        });

    }
</script>
</body>
</html>
