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
                        <div class="alert {{session('isSuccess') ? "alert-success" : "alert-danger"}}" role="alert" style="    margin: 0 20px 20px 20px;">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.send-email') }}">
                        @csrf

                        <div class="row">
                            <label style="text-align: right" for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6  col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
