@extends('frontend.layout.index')
@section('content')
    @include('frontend.product.components.advertise-section')
    <section>
        <div class="container">
            <div class="row">
               <div class="col-sm-12" style="text-align: center">
                   @if($isSuccess)
                       <i class="fa fa-check" style="font-size: 40px; color: lightgreen"></i>
                   @else
                       <i class="fa fa-exclamation" style="font-size: 40px; color: orangered"></i>
                   @endif
                       <h2>{{$message}}</h2>
               </div>
                <div class="col-sm-12 text-center" style="padding:15px 0">
                    <a href="/" class="btn btn-info">Go back to shop</a>
                </div>

            </div>
        </div>
    </section>
@endsection
