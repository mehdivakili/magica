@extends('layouts.out',['page_title'=>'Verify Email Address'])

@section('content')


    @include('widget.div-style-start',['classes'=>'login-form offset-2 d-flex flex-column','style'=>'text-align: justify','title'=> __('Verify Your Email Address'),'info'=>false ])
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }}
    <form class="d-flex flex-column " style="flex: 1 1 auto; justify-content: flex-end" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-gradient" style="margin-top: 40px">{{ __('click here to request another') }}</button>
    </form>
    <form   method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-gray" style="width: 100%; margin-top: 1.1rem">{{ __('Back') }}</button>
    </form>
    @include('widget.div-style-end')
@endsection
