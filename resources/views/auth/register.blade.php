@extends('layouts.out',['page_title'=>'Register'])

@section('content')

    @include('widget.div-style-start',['classes'=>' login-form offset-2','title'=>__('Register'),'info'=>false])


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">


            <div>
                <input id="name" type="text" placeholder="{{__("Name")}}"
                       class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <div>
                <input id="email" placeholder="{{ __("E-Mail Address") }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <div>
                <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">

            <div>
                <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="form-group row mb-0">
            <div>
                <button type="submit" class="btn btn-gradient" style="width: 100%">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
        <div class="form-group row d-flex justify-content-between align-items-center col-12 "
             style="width: 100%;padding: 0;margin-right: 0; flex-wrap: nowrap; margin-bottom: 0; margin-top: 15px">
            <a class="btn" style="width: 100%" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </div>
    </form>
    @include('widget.div-style-end')

@endsection
