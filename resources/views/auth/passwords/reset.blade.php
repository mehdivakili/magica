@extends('layouts.out')

@section('content')

            @include('widget.div-style-start',['classes'=>'login-form offset-2','title'=>__('Reset Password'),'info'=>'false'])

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">

                    <div>
                        <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">


                    <div>
                        <input id="password" placeholder="{{ __('Password') }}" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">


                    <div>
                        <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password"
                               class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-gradient">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
            @include('widget.div-style-end')

        </div>

    </div>
@endsection
