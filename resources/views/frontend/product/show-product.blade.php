@extends('frontend.layout.index')
@section('content')
    @include('frontend.product.components.advertise-section')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.components.left-sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    @include('frontend.product.components.feature-product-paginate')
                </div>
            </div>
        </div>
    </section>
@endsection
