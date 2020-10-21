<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="/" class="active">Home</a></li>
        @foreach ($categoryMainMenu as $parentC)
            <li class="dropdown">
                <a href="#">{{$parentC->name}} @if($parentC->childCategory()->count() > 0 )<i class="fa fa-angle-down"></i>@endif</a>
              @include('frontend.components.child-category', ['parentC' => $parentC])
            </li>
        @endforeach
        <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="shop.html">Products</a></li>
                <li><a href="product-details.html">Product Details</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="blog.html">Blog List</a></li>
                <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
        </li>
        <li><a href="contact">Contact</a></li>
    </ul>
</div>
