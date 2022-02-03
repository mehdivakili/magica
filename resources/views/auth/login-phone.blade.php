@extends('layouts.out',['page_title'=>'Login'])

@section('content')
    @include('widget.div-style-start',['classes'=>'login-form offset-2','title'=> __('Login to system'),'info'=>false ])


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <div>
                <input id="phone_number" placeholder="{{ __('Phone number') }}"
                       class="form-control  @error('phone_number') is-invalid @enderror" name="phone_number"
                       value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <div>
                <input id="password" type="password" placeholder="{{__('Password')}}"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row justify-content-start" hidden
             style="margin: 0;padding: 0;margin-bottom: 16px;">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" checked>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-gradient" style="margin-bottom: 10px">
            {{ __('Login') }}
        </button>

        <div class="form-group row d-flex justify-content-between align-items-center col-12 "
             style="width: 100%;padding: 0;margin-right: 0; flex-wrap: nowrap; margin-bottom: 0; margin-top: 15px">
            @if (Route::has('password.request'))
                <a class="btn " href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif


            <a class="btn" href="{{ route('register') }}">
                {{ __('Create new account') }}
            </a>

        </div>
    </form>

    @include('widget.div-style-end')

@endsection
