<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('metaSEOTag')
    <!-- META FOR FACEBOOK -->
    <meta property="og:site_name" content="{{url('/')}}"/>
    <meta property="og:rich_attachment" content="true"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" itemprop="url" content="{{url('/')}}"/>
    <meta property="og:image" itemprop="thumbnailUrl" content="https://s1.vnecdn.net/vnexpress/restruct/i/v345/logo_default.jpg"/>
    <meta content="HiTechShopping - Trang mua hàng điện tử " itemprop="headline" property="og:title"/>
    <meta content="Trang chuyên về các thiết bị điện tử, máy tính, laptop, đồ gia dụng" itemprop="description" property="og:description"/>
    <!-- END META FOR FACEBOOK -->
    <meta name="copyright" content="HiTechShopping"/>
    <meta name="author" content="HiTechShopping"/>
    <meta name="robots" content="index, follow"/>
    <meta name="geo.placename" content="Ho Chi Minh, Viet Nam"/>
    <meta name="geo.region" content="VN-HCM"/>
    <meta name="geo.position" content="21.030624;105.782431"/>
    <meta name="ICBM" content="21.030624, 105.782431"/>
    <meta name="revisit-after" content="days"/>
    <!-- Twitter Card -->
    <meta name="twitter:card" value="summary"/>
    <meta name="twitter:url" content="{{url('/')}}"/>
    <meta name="twitter:title" content="HiTechShopping - Trang mua hàng điện tử"/>
    <meta name="twitter:description" content="Trang chuyên về các thiết bị điện tử, máy tính, laptop, đồ gia dụng"/>
    <meta name="twitter:image" content="https://s1.vnecdn.net/vnexpress/restruct/i/v345/logo_default.jpg"/>
    <meta name="twitter:site" content="@HiTechShopping"/>
    <meta name="twitter:creator" content="@HiTechShopping"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- End Twitter Card -->
    <base href="{{asset('')}}">
    <link href="frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="frontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="frontend/css/price-range.css" rel="stylesheet">
    <link href="frontend/css/animate.css" rel="stylesheet">
    <link href="frontend/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="frontend/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="frontend/js/html5shiv.js"></script>
    <script src="frontend/js/respond.min.js"></script>

    <![endif]-->
    <link rel="shortcut icon" href="frontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="frontend/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="frontend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="frontend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="frontend/images/ico/apple-touch-icon-57-precomposed.png">
    @yield('css')
    <style>
        .fb_dialog_content iframe
        {
            bottom: 75px !important;
        }
    </style>
</head><!--/head-->

<body>


@include('frontend.components.header')

{{--@guest--}}
{{--    @include('frontend.partials.login')--}}
{{--    @include('frontend.partials.register')--}}
{{--@endguest--}}

@yield('content')
@include('frontend.components.footer')

<script src="frontend/js/jquery.js"></script>
<script src="frontend/js/jquery.js"></script>
<script src="frontend/js/bootstrap.min.js"></script>
<script src="frontend/js/jquery.scrollUp.min.js"></script>
<script src="frontend/js/price-range.js"></script>
<script src="frontend/js/jquery.prettyPhoto.js"></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
        appId: "{{ env("ONESIGNAL_APP_ID") }}",
        autoRegister: false,
        notifyButton: {
            enable: true
        },
        promptOptions: {
            siteName: "Laravel Webpush Notification",
            actionMessage: "Bạn có muốn nhận thông báo khi chúng tôi có sản phẩm mới hay không?",
            acceptButtonText: "ĐỒNG Ý",
            cancelButtonText: "KHÔNG, CẢM ƠN",
        }
    }]);
    OneSignal.push(function() {
        OneSignal.showHttpPrompt();
    });
</script>
<script src="frontend/js/main.js"></script>
@yield('js')
{{--Script for search product inside header component--}}
<script>
    $(function(){

{{--        @if($errors->has('email') || $errors->has('password') || session('message'))--}}
{{--        $('#loginModal').modal({--}}
{{--            show: true--}}
{{--        });--}}
{{--        @endif--}}

{{--        $('#registerForm').submit(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            let formData = $(this).serializeArray();--}}
{{--            // let formData2 = $(this).serialize();--}}
{{--            console.log(formData)--}}
{{--            // console.log(formData2)--}}
{{--            $(".invalid-feedback").children("strong").text("");--}}
{{--            $("#registerForm input").removeClass("is-invalid");--}}
{{--            $.ajax({--}}
{{--                method: "POST",--}}
{{--                headers: {--}}
{{--                    Accept: "application/json"--}}
{{--                },--}}
{{--                url: "{{ route('register-frontend') }}",--}}
{{--                data: formData,--}}
{{--                success: () => window.location.assign("{{ route('home') }}"),--}}
{{--                error: (response) => {--}}
{{--                    console.log(response)--}}
{{--                    if(response.status === 422) {--}}
{{--                        let errors = response.responseJSON.errors;--}}
{{--                        Object.keys(errors).forEach(function (key) {--}}
{{--                            $("#" + key + "Input").addClass("is-invalid");--}}
{{--                            $("#" + key + "Error").children("strong").text(errors[key][0]);--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        window.location.reload();--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}



        $('.search-form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                if($.trim($('.search-text').val()) == '')
                {
                    e.preventDefault();
                    return false;
                }
                //Otherwise form still auto submit as default action
            }
        });

    })
</script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v8.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="109443327592116"
     logged_in_greeting="Hi! Chúng tôi có thể giúp gì cho bạn ạ?"
     logged_out_greeting="Hi! Chúng tôi có thể giúp gì cho bạn ạ?">
</div>
@auth
    <script src="js/enable-push.js" defer></script>
@endauth


</body>
</html>
