@extends('frontend.layout.index')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            @if(session('message'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-danger">
                            {{session('message')}}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="user-sign-in" method="post">
                            @csrf
                            <input type="email" name="email" class=" @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="password" name="password"  class=" @error('password') is-invalid @enderror" placeholder="Password">

                            @error('password')
                            <div class="invalid-feedback" role="alert">
                                  {{ $message }}
                                </div>
                            @enderror
                            <span>
								<input type="checkbox" name="remember" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" style="width: 100%" class="btn btn-default btn-md text-center">Login</button>
                            <a href="#" data-title="Login with Facebook" data-social-login = '{{url('login/facebook')}}'  style="margin-top: 10px; display: block" class="btn btn-default btn-md  text-center d-block social-login">Log in with Facebook</a>
                            <a href="#" data-title="Login with Google" data-social-login = '{{url('login/google')}}'  style="margin-top: 10px; display: block" class="btn btn-default btn-md  text-center d-block social-login">Log in with Google</a>
                            <a href="{{route('password.request')}}" class="forgot-pass">Forgot your password?</a>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-7">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="user-register" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="name" placeholder="Name"
                                           value="@if($errors->any()){{old('name')}}@endif"
                                           class="@error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <input type="email" name="email_register" placeholder="Email Address"
                                           value="@if($errors->any()){{old('email_register')}}@endif"
                                           class="@error('email_register') is-invalid @enderror">
                                    @error('email_register')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <input type="password" name='password_register' placeholder="Password"
                                           class="@error('password_register') is-invalid @enderror">
                                    @error('password_register')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <input type="password" name="password_confirmation" placeholder="Confirm password"
                                           class="@error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <textarea name="address" id="" cols="30" rows="10" placeholder="Address"
                                              class="@error('address') is-invalid @enderror">@if($errors->any()){{old('address')}}@endif</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input name="postal-code" type="text" placeholder="Zip / Postal Code *"
                                           value="@if($errors->any()){{old('postal-code')}}@endif">
                                    <select name="city" style="margin-bottom: 10px;height: 40px;"
                                            class="city-select @error('city') is-invalid @enderror">
                                        <option disabled>-- City --</option>
                                        @foreach ($cities as $c)
                                            <option data-url="{{url('/get-district-by-city').'/'.$c->id}}"
                                                    @if($errors->any() && !empty(old('city')) && $c->id == old('city')) selected
                                                    @endif value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <select name="district" style="margin-bottom: 10px;height: 40px;"
                                            class="district-select @error('district') is-invalid @enderror">
                                        <option disabled>-- District --</option>
                                        @if($errors->any() && !empty(old('city')))
                                            @foreach ($cities->where('id', old('city'))->first()->districts as $d)
                                                <option value="{{$d->id}}" @if($d->id == old('district')) selected @endif>{{$d->name}}</option>
                                            @endforeach
                                        @else
                                            @foreach ($cities[0]->districts as $d)
                                                <option value="{{$d->id}}">{{$d->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('district')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                    <input type="text" name="phone" placeholder="Phone *"
                                           class="@error('phone') is-invalid @enderror"
                                           value="@if($errors->any()){{old('phone')}}@endif">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default" style="margin-top: 10px">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>

            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .forgot-pass
        {
            border-bottom: 1px solid transparent;
            display: inline-block;
            margin-top: 5px;
            text-decoration: none !important;
        }
        .forgot-pass:hover
        {border-bottom: 1px solid #1d68a7 !important;
        }
    </style>
@endsection
@section('js')
    <script>
        $(function () {
            $('.city-select').change(function () {
                var url_get = $(this).find(':selected').data('url');
                console.log(url_get)
                $.ajax({
                    type: 'get',
                    url: url_get,
                    success: function ($respond) {
                        if ($respond.code == 200) {
                            $('.district-select').html($respond.data)
                        } else {
                            alert($respond.message)
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // alert('Internal error: ' + jqXHR.responseJSON.message)
                        alert('Internal error: ' + jqXHR.responseText);
                    }
                })
            })
        })
        // var signinWin;



        $('.social-login').click(function (event) {
            //   var pos = screenCenterPos(800, 500);
            event.preventDefault();
            var social_login_url = $(this).data('social-login');
            var social_title =  $(this).data('title');
            var signinWin = window.open(social_login_url, "SignIn", "width=780,height=410,toolbar=0,scrollbars=0,status=0,resizable=0,location=0,menuBar=0,left=" + 500 + ",top=" + 200);
            signinWin.document.title = social_title;
            var timer = setInterval(function() {
                if(signinWin.closed) {
                    clearInterval(timer);
                    location.reload(true);
                }
            }, 1000);

        });



    </script>
@endsection
