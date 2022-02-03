@extends('layouts.out',['title'=>'Main page'])
@section('content')

    <style>
        .btn{
            background-color: #007bff;
        }
        .card{
            border-radius: 28px;
        }
        body{
            background: linear-gradient(0.825turn,#92278f  50%,#01adee 50%) fixed !important;
        }
    </style>
    <div class="offset-2 card" style="width: 300px">
        <div class="card-header">به مجیکا خوش آمدید</div>
        <div class="card-body" style="padding: 30px; text-align: center">
            مهدی وکیلی نی ریزی<br>
            سینا میرزایی شبانی <br>
            مجید موذنی <br>
        </div>
        <div class="card-footer d-flex justify-content-around">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn btn-lg btn-primary" href="{{ url('/home') }}">خانه</a>
                    @else
                        <a class="btn btn-lg btn-primary" href="{{ route('login') }}">ورود</a>

                        @if (Route::has('register'))
                            <a class="btn btn-lg btn-primary" href="{{ route('register') }}">ثبت نام</a>
                        @endif
                    @endauth
                </div>
            @endif


        </div>
    </div>

@stop
