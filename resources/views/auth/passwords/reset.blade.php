@extends('frontend.layout.index')

@section('content')

<div class="container" style="    padding: 20px 0;">
    <div class="row" style="    display: flex;
    justify-content: center;">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid;">
                <div class="card-header" style="text-align: center;
    padding: 8px 0;
    background: #80808038;">{{ __('Reset Password') }}</div>

                <div class="card-body" style="padding: 20px 0;">
                    @if (session('message'))
                        <div class="alert {{session('isSuccess') ? "alert-success" : "alert-danger"}}" role="alert" style="  margin: 0 20px 20px 20px;">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.password-reset') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email"  style="text-align: right" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" style="text-align: right" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" style="text-align: right" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  @error('password_confirmation') is-invalid @enderror class="form-control" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
