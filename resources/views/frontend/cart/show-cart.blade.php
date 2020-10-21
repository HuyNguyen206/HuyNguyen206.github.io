@extends('frontend.layout.index')
@section('css')
    <link rel="stylesheet" href="frontend/cart/cart.css">
@endsection
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info" data-update="{{url("update-cart")}}">
                @include('frontend.cart.components.cart-component')
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action_coupon">
        <div class="container">
            <div class="heading">
                <h3>Promotion Coupon</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area" style="padding-bottom: 30px !important;">
                        <input type="text" value="{{Session::get('couponCode') ?? ''}}" style="    padding-left: 10px" placeholder="Coupon code..." name="coupon" class="coupon_code" >
                        <a class="btn btn-default apply_coupon" style="margin-top: 0" href=""  data-coupon = {{URL::to('/').'/apply-coupon'}}>Use this coupon</a>
                        <a class="btn btn-default remove_coupon" style="margin-top: 0" @if(!Session::get('couponCode')) disabled @endif href="" data-coupon = {{URL::to('/').'/remove-coupon'}}>Remove this coupon</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="total_area" style="padding-bottom: 30px !important;">
                        <a class="btn btn-default update" style="margin-top: 0" href="">Back to store</a>
                        <a class="btn btn-default check_out" style="margin-top: 0" @if(empty($cart) ) disabled="disabled" @endif href="checkout">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
@section('js')
    <script src="frontend/vendors/sweetAlert2/sweetalert2@9.js"></script>
    <script src="frontend/cart/show-cart.js"></script>
@endsection



