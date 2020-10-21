@extends('frontend.layout.index')
@section('css')
    <link rel="stylesheet" href="frontend/home/home.css">
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.components.left-sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                @include('frontend.search.components.search-result')
                <!--features_items-->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-9 text-center">
                    {!! $products->appends(['key_search' => $key_search])->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="frontend/vendors/sweetAlert2/sweetalert2@9.js"></script>
    <script>
        $(function () {
            $('.add-to-cart').click(function (event) {
                event.preventDefault();
                let urlCart = $(this).data('url');
                $.ajax({
                    type: 'GET',
                    url: urlCart,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code === 200) {
                            Swal.fire(
                                'Success!',
                                'The product already is added to cart!',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            )
                        }

                    },
                    error: function (data) {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        )
                    }

                })
            })
        })

    </script>
@endsection
