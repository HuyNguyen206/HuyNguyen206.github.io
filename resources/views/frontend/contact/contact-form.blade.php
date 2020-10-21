@extends('frontend.layout.index')

@section('content')
    <div id="contact-page" class="container">
        <div class="bg">

            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        @if (session('message'))
                            <div class="alert {{session('isSuccess') ? "alert-success" : "alert-danger"}}" role="alert"
                                 style="  margin: 0 20px 20px 20px;">
                                {!! session('message') !!}
                            </div>
                        @endif
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post"
                              action="contact">
                            @csrf
                            <div class="form-group col-md-6">
                                <input type="text" name="name" value="@if($errors->any()){{old('name')}}@endif"
                                       class="form-control @error('name') is-invalid @enderror" required="required"
                                       placeholder="Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" value="@if($errors->any()){{old('email')}}@endif"
                                       class="form-control  @error('email') is-invalid @enderror" required="required"
                                       placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" value="@if($errors->any()){{old('subject')}}@endif"
                                       class="form-control @error('subject') is-invalid @enderror" required="required"
                                       placeholder="Subject">
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required"
                                          class="form-control  @error('message') is-invalid @enderror" rows="8"
                                          placeholder="Your Message Here">@if($errors->any()){{old('message')}}@endif</textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="captcha-wrapper" style="clear: both;padding-left: 15px;">
                                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                <br/>
                                @if($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" style="display:block">
                                       <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                 </span>
                                @endif
                            </div>


                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection




