@extends('layouts.out')

@section('content')
    @include('widget.div-style-start',['classes'=>'login-form offset-2','title'=> __('Register') ])
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input id="name" hidden type="text" placeholder="{{__("Name")}}"
               class="form-control @error('name') is-invalid @enderror"
               name="name" value="{{ $name ?? old('name')}}" required autocomplete="name" autofocus>
        <input id="phone_number" hidden placeholder="{{ __('Phone number') }}"
               class="form-control @error('phone_number') is-invalid @enderror"
               name="phone_number" value="{{ $phone_number?? old('phone_number')}}" required autocomplete="phone_number">
        <div class="form-group row">
            <div>
                <input id="password" type="password" placeholder="{{ __('Password') }}"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <div>
                <input id="password-confirm" type="password" class="form-control"
                       placeholder="{{ __('Confirm Password') }}"
                       name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div  class="form-group row">
            <div>
            <input id="code" class="form-control"
                   placeholder="{{ __('Code') }}"
                   name="code" >
            </div>
        </div>

        <div class="form-group row mb-0">
            <div>
                <button type="submit" class="btn" style="width: 100%">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

    @include('widget.div-style-end')

@endsection
