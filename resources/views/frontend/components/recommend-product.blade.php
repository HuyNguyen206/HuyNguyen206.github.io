<div class="recommended_items">
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                @foreach ($recommendProducts->chunk(3) as $key => $itemSlider)
                <div class="item  {{$key == 0 ? "active" : ""}}">
                    @foreach ($itemSlider as $rp)
                        <div class="col-lg-4 col-md-6">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{$rp->category->slug.'/'.$rp->id.'/'.to_slug($rp->name)}}">
                                            <img src="{{$rp->feature_image_path}}" alt="">
                                            <h2>${{number_format($rp->price, 2)}}</h2>
                                            <p>{{$rp->name}}</p>
                                        </a>

                                        <div class="btn-group">
                                            <a href="#" class="btn btn-default add-to-cart" data-url="add-to-cart/{{$rp->id}}"><i class="fa fa-cart-plus"></i>Add to cart</a>
                                            <a href="show-cart" class="btn btn-success"><i class="fa fa-shopping-cart" style="margin-right: 5px;"></i>Go to cart</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel"
           data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel"
           data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
