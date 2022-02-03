@extends('layouts.out')

@section('content')

            @include('widget.div-style-start',['classes'=>'login-form offset-2','title'=> __('Reset Password'), 'info'=>false ])




            @if (session('status'))
                <div class="alert alert-success" style="text-align: justify" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">


                    <div>
                        <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div>
                        <button type="submit" class="btn btn-gradient">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
            @include('widget.div-style-end')

@endsection
