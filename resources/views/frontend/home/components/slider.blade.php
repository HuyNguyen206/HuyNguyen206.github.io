<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($sliders as $key => $s)
                            <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="{{$key == 0 ? "active" : ""}}"></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $s)
                            <div class="item {{$key == 0 ? "active" : ""}}">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>{{$s->name}}</h2>
                                    <p>{{$s->description}} </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{$s->image_path}}" class="girl img-responsive slider-image-custom" alt="">
{{--                                    <img src="images/home/pricing.png" class="pricing" alt="">--}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
