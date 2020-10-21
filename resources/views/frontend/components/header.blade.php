<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            {{--                            <li><a href="#"><i class="fa fa-phone"></i>{{$settings->firstWhere('config_key', 'phone_contact')->config_value}} </a></li>--}}
                            {{--                            <li><a href="#"><i class="fa fa-envelope"></i>{{$settings->firstWhere('config_key', 'email')->config_value}} </a></li>--}}
                            <li><a href="#"><i class="fa fa-phone"></i>{{getConfigValueByConfigKey('phone_contact')}}
                                </a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>{{getConfigValueByConfigKey('email')}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ getConfigValueByConfigKey('facebook_link') }}"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="{{  getConfigValueByConfigKey('twitter_link') }}"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="{{  getConfigValueByConfigKey('linkedin_link')  }}"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{  getConfigValueByConfigKey('twitter_link')  }}"><i
                                        class="fa fa-dribbble"></i></a></li>
                            <li><a href="{{  getConfigValueByConfigKey('google_plus_link') }}"><i
                                        class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href=""><img src="frontend/images/home/logo.png" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="show-cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @auth
                                <li><a href="checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
                                <li><a href="logout"><i class="fa fa-user"></i> Log out</a></li>
                            @else
                                <li><a href="login"><i class="fa fa-lock"></i> Login</a></li>

{{--                                <li>--}}
{{--                                    <a class="nav-link"--}}
{{--                                       style="cursor: pointer"--}}
{{--                                       data-toggle="modal"--}}
{{--                                       data-target="#loginModal">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="nav-link"--}}
{{--                                       style="cursor: pointer"--}}
{{--                                       data-toggle="modal"--}}
{{--                                       data-target="#registerModal">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
                            @endauth





                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    @include('frontend.components.main-menu')
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="search-product" method="get" class="search-form">
                            <input type="text" class="search-text" name="key_search" value="{{isset($key_search)?$key_search:''}}" placeholder="Search"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->




