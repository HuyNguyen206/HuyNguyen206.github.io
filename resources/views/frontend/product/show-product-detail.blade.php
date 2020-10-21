@extends('frontend.layout.index')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.components.left-sidebar')
                </div>
                    <div class="col-sm-9 padding-right">
                        @include('frontend.product.components.product-detail-section')

                        @include('frontend.product.components.product-category-tab')
                        <div class="fb-comments" data-href="{{$urlCanocical}}" data-numposts="5" data-width="100%"></div>
                        @include('frontend.components.recommend-product')

                    </div>
            </div>
        </div>
    </section>
@endsection
@section('metaSEOTag')
    {!!$metaSEOTag!!}
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    <style>
        .carousel-detail-product a img {
            width: 270px;
            height: 200px !important;
            object-fit: contain;
            margin-left: 25px !important;
        }
        .view-product {
            position: relative;
            height: 403px;
            border: 1px solid #F7F7F0;
        }
        .view-product img
        {
            object-fit: contain;
            border:none;
        }
        .product-information span span {
            font-size: 15px;
            margin-top: 10px;
        }

        .product-information {
            height: 403px;
        }


        /*.product-information > span  {*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*}*/

    </style>
    @endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <script src="frontend/vendors/sweetAlert2/sweetalert2@9.js"></script>
    <script src="frontend/product/show-detail.js"></script>
@endsection
