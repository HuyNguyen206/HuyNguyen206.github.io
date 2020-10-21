@extends('frontend.layout.index')
@section('content')

<body style="">
<div class="container text-center">
    <div class="logo-404">
        <a href="index.html"><img src="frontend/images/home/logo.png" alt=""></a>
    </div>
    <div class="content-404">
        <img src="frontend/images/404/404.png" class="img-responsive" alt="">
        <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
        <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
        <h4><a href="/" class="btn btn-warning" >Bring me back Home</a></h4>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>

@endsection
