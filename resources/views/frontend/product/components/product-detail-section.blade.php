<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <a href="{{$product->feature_image_path}}" data-fancybox="gallery" data-caption="{{$product->feature_image_name}}">
                <img src="{{$product->feature_image_path}}" alt="" />
                <h3>ZOOM</h3>
            </a>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <h2>{{$product->name}}</h2>
            <p>Web ID: {{$product->id}}</p>
            <img src="images/product-details/rating.png" alt="">
            <span>
									<span>{{number_format($product->price, 2)}} VNĐ</span>
									<label>Quantity:</label>
									<input type="text" value="1" class="quantity" name="quantity">
									<button type="button" class="btn btn-fefault cart" data-id="{{$product->id}}" data-url="add-to-cart/{{$product->id}}">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b>{{(isset($product->category->parentCategory) ? $product->category->parentCategory->name."-".$product->category->name : $product->category->name) }}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt=""></a>
        </div><!--/product-information-->
        <div class="row">
            <div class="col-sm-12 text-right">
                <div class="fb-like" data-href="http://laravel-hitech-shopping.com/" data-width="" data-layout="standard" data-action="recommend" data-size="large" data-share="true"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-detail-product">
                @foreach ($product->productImages->chunk(2) as $itemProducts)
                    <div class="item {{$loop->index == 0 ? 'active' : ''}}">
                        @foreach ($itemProducts as $ip)
                            <a href="{{$ip->image_path}}" data-fancybox="gallery" data-caption="{{$ip->image_name}}">
                                <img src="{{$ip->image_path}}" alt="" />
                            </a>
                        @endforeach
                    </div>
                @endforeach

            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div><!--/product-details-->
