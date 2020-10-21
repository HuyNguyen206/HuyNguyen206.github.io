@php
use App\Product;
use App\Traits\Helper;
@endphp

<table class="table table-condensed">
    <colgroup>
        <col  style="width: 15% !important;">
        <col  style="width: 30% !important;">
        <col  style="width: 15% !important;">
        <col  style="width: 15% !important;">
        <col  style="width: 20% !important;">
        <col  style="width: 5% !important;">
    </colgroup>
    <thead>
    <tr class="cart_menu">
        <td class="image">Item</td>
        <td class="description"></td>
        <td class="price">Price</td>
        <td class="quantity">Quantity</td>
        <td class="total">Total</td>
        <td></td>
    </tr>
    </thead>
    <tbody class="tbody-wrapper">
    @php
        $totalPrice = 0;
    @endphp
    @forelse($cart as $id => $item)
        @php
            $totalPrice += $item['quantity'] * $item['price'];
            $productItem = Product::find($id);
        @endphp
        <tr data-has-item="true">
            <td class="cart_product">
                <a href="{{$productItem->category->slug.'/'.$productItem->id.'/'.to_slug($productItem->name)}}"><img src="{{$item['feature_image_path']}}" alt=""></a>
            </td>
            <td class="cart_description">
                <h4><a href="{{$productItem->category->slug.'/'.$productItem->id.'/'.to_slug($productItem->name)}}">{{$item['name']}}</a></h4>
            </td>
            <td class="cart_price">
                <p>{{number_format($item['price'], 2)}} VND</p>
            </td>
            <td class="cart_quantity">
                <div class="cart_quantity_button" data-id="{{$id}}">
                    <a class="cart_quantity_up" href=""> + </a>
                    <input class="cart_quantity_input" type="number" min="1" required name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                    <a class="cart_quantity_down" href=""> - </a>
                </div>
            </td>
            <td class="cart_total">
                <p class="cart_total_price">{{number_format($item['quantity'] * $item['price'])}} VND</p>
            </td>
            <td class="cart_delete">
                <a class="cart_quantity_delete" data-url-remove = {{url('remove-cart-product').'/'.$id}} href=""><i class="fa fa-times"></i></a>
            </td>
        </tr>

    @empty
        <tr data-has-item="false">
            <td colspan="6"> You haven't add product to cart yet</td>
        </tr>

    @endforelse
    <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="3">
            <table class="table table-condensed total-result" style="    text-align: right;">
                <tbody><tr>
                    <td>Cart Sub Total</td>
                    <td>{{number_format($totalPrice, 2)}} VND</td>
                </tr>
                <tr>
                    <td>Tax(10%)</td>
                    <td>{{number_format($totalPrice/10, 2)}} VND</td>
                </tr>
                <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><span>{{number_format($totalPrice + $totalPrice/10, 2)}} VND</span></td>
                </tr>
                @if(isset($couponCode))
                <tr>
                    <td>Coupon Type</td>
                    <td>
                       {{$couponCode->name. '-' . $couponCode->couponType->name}}
                    </td>
                </tr>
                @if($couponCode->coupon_type == 2)
                <tr>
                    <td>Coupon value</td>
                    <td>
                        Giảm {{$couponCode->code_value}}%
                    </td>
                </tr>
                @endif
                <tr style="border-bottom: 1px solid #F7F7F0;">
                    <td>Số tiền được giảm</td>
                    <td>
                        @if($couponCode->coupon_type == 1)
                            Giảm {{number_format($couponCode->code_value, 2)}} VND
                        @else
                            Giảm {{number_format( (($totalPrice + $totalPrice/10)/ 100)* $couponCode->code_value, 2) }} VND
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Số tiền sau khi giảm
                    </td>
                    <td><span>
                        @if($couponCode->coupon_type == 1)
                            {{number_format($totalPrice + $totalPrice/10 - $couponCode->code_value, 2)}} VND
                        @else
                            {{number_format($totalPrice + $totalPrice/10 - (($totalPrice + $totalPrice/10)/ 100)* $couponCode->code_value, 2)  }}
                        @endif
                        </span>
                    </td>
                </tr>
                @endif
                </tbody></table>
        </td>
    </tr>
    </tbody>
</table>

