@extends('frontend.layout.index')
@section('css')
    <link rel="stylesheet" href="frontend/cart/cart.css">
@endsection
@section('content')
    @if(isset($user))
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Check out</li>
                    </ol>
                </div><!--/breadcrums-->
                <form method="post" action="order">
                    @csrf
                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="shopper-info">
                                    <h3>Shipping Address </h3>
                                    <h5><b>{{$user->name}} - {{$user->customer->phone}}</b></h5>
                                    <p>{{$user->customer->city->name}}, {{$user->customer->district->name}}</p>
                                    <p>{{$user->customer->address}}</p>
                                </div>
                                <div class="transport-company" style="margin-top: 30px">
                                    <h3>Transport Company</h3>
                                    <div class="transport-options" style="margin-bottom: 0">
                                        @foreach ($transportCompanies as $tc)
                                            <span style="margin-right: 10px">
						                        <label style="font-weight: normal"><input class="@error('transport_company') is-invalid @enderror" type="radio" name="transport_company" value="{{$tc->id}}"> {{$tc->name}}</label>
					                        </span>
                                        @endforeach
                                    </div>
                                    @error('transport_company')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="order-message">
                                    <p>Shipping Note</p>
                                    <textarea name="order_note"
                                              placeholder="Notes about your order, Special Notes for Delivery"
                                              rows="16"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-payment">
                        <h2>Review &amp; Payment</h2>
                    </div>
                    <div class="table-responsive cart_info" data-update="{{url("update-cart")}}">
                        @include('frontend.cart.components.cart-component')
                    </div>
                    <div class="payment-options" style="margin-bottom: 0">
                        @foreach ($paymentMethods as $p)
                            <span>
						<label for="payment_{{$p->id}}"><input id="payment_{{$p->id}}" class="@error('payment_method') is-invalid @enderror form-check-input" type="radio" name="payment_method" value="{{$p->id}}"> {{$p->name}}</label>
					</span>
                        @endforeach
                    </div>
                    @error('payment_method')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <a href="show-cart" class="btn btn-primary back-to-cart-btn" style="margin-bottom: 100px" >Back to cart</a>
                    <input type="submit" class="btn btn-primary order-btn" style="margin-bottom: 100px" @if(empty($cart) ) disabled="disabled" @endif  value="Order">
                </form>

                @else
                    <div class="register-req text-center">
                        <p>Please use Register/Login to get access to your order</p>
                        <a href="login" class="btn btn-info">Register/Login</a>
                    </div>
                @endif
            </div>
        </section>
@endsection
@section('js')
    <script src="frontend/vendors/sweetAlert2/sweetalert2@9.js"></script>
    <script src="frontend/checkout/show-cart-with-order.js"></script>
@endsection
