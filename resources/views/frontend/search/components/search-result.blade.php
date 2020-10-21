<div class="features_items">
    <h2 class="title text-center">Search Result</h2>
    <div class="row">


    @foreach ($products as $p)
{{--        @if (($loop->iteration)%3 == 1)--}}
{{--            <div class="row">--}}
{{--                @endif--}}
                <div class="col-sm-6 col-lg-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{$p->feature_image_path}}" alt="">
                                <h2><a  style="color: #FE980F" href="{{$p->category->slug.'/'.$p->id.'/'.to_slug($p->name)}}">{{number_format($p->price, 2)}} VND</a></h2>
                                <p><a href="{{$p->category->slug.'/'.$p->id.'/'.to_slug($p->name)}}">{{$p->name}}</a></p>
                                <a href="#" class="btn btn-default add-to-cart" data-url="add-to-cart/{{$p->id}}"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2><a href="{{$p->category->slug.'/'.$p->id.'/'.to_slug($p->name)}}">{{number_format($p->price, 2)}} VND</a></h2>
                                    <p><a href="{{$p->category->slug.'/'.$p->id.'/'.to_slug($p->name)}}">{{$p->name}}</a></p>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-default add-to-cart"
                                           data-url="add-to-cart/{{$p->id}}"><i class="fa fa-cart-plus"></i>Add to cart</a>
                                        <a href="show-cart" class="btn btn-success"><i class="fa fa-shopping-cart"
                                                                                       style="margin-right: 5px;"></i>Go
                                            to cart</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

{{--                @if (($loop->iteration)%3 == 0)--}}
{{--            </div>--}}
{{--        @endif--}}
    @endforeach
    </div>
</div>
