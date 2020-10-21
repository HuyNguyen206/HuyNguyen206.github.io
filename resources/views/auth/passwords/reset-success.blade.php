@extends('frontend.layout.index')

@section('content')
<div class="container" style="    padding: 20px 0;">
    <div class="row" style="    display: flex;
    justify-content: center;">
        <div class="col-md-8">
            <div class="card"  style="border: 1px solid;">
                <div class="card-header" style="text-align: center;
    padding: 8px 0;
    background: #80808038;">{{ __('Reset Password') }}</div>

                <div class="card-body" style="padding: 20px 0;">
                        <div class="alert alert-success" role="alert" style="  margin: 0 20px 20px 20px;">
                            {{ $message }}
                        </div>
                    <a href="/" class="btn btn-md">Click here to return to the home page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
