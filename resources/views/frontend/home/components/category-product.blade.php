<div class="category-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach ($categories as $key => $c)
                <li class="{{$key == 0 ? "active" : ""}}"><a href="#category-{{$c->slug}}" data-toggle="tab">{{$c->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach ($categories as $key => $parentCategory)
            <div class="tab-pane fade {{$key == 0 ? "active in" : ""}} " id="category-{{$parentCategory->slug}}">
                @foreach ($parentCategory->productChildCategory()->latest()->take(4)->get() as $product)
                    <div class="col-lg-3 col-md-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{$product->category->slug.'/'.$product->id.'/'.to_slug($product->name)}}">
                                        <img src="{{$product->feature_image_path}}" alt="">
                                        <h2>${{number_format($product->price, 2)}}</h2>
                                        <p class="category-product-tab">{{$product->name}}</p>
                                    </a>
                                    <a href="#" class="btn btn-default add-to-cart" data-url="add-to-cart/{{$product->id}}"><i class="fa fa-cart-plus"></i>Add to cart</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
