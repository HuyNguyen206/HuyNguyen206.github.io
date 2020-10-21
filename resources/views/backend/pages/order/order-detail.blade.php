@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Order Detail','action'=>'Chi tiết Order'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  text-center bg bg-cyan">
                                <h3 class="card-title float-none">Thông tin khách hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Address</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$order->customer->user->name}}</td>
                                        <td>{{$order->customer->phone}}</td>
                                        <td>{{$order->customer->user->email}}</td>
                                        <td>{{$order->customer->city->name}}</td>
                                        <td>{{$order->customer->district->name}}</td>
                                        <td>{{$order->customer->address}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  text-center bg bg-cyan">
                                <h3 class="card-title float-none">Chi tiết đơn hàng</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Số lượng mua</th>
                                        <th>Ngày tạo</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->orderDetails as $od)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$od->product->name}}
                                            </td>
                                            <td>
                                                {{number_format($od->product_price,2)}}
                                            </td>
                                            <td>
                                                {{$od->product_sale_quantity}}
                                            </td>
                                            <td>
                                                {{$od->created_at}}
                                            </td>
                                            <td>
                                                <div class="btn btn-group">
                                                    {{--                                            @can('update', App\Menu::class)--}}
                                                    <a href="" class="btn btn-success"> View detail</a>
                                                    {{--                                            @endcan--}}
                                                    {{--                                            @can('delete', App\Menu::class)--}}
                                                    <a href="" class="btn btn-danger"> Xóa</a>
                                                    {{--                                            @endcan--}}
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

                    <div class="card card-primary ">
                        <div class="card-header bg bg-cyan">
                            <h3 class="card-title text-center float-none ">Chi tiết bill</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row">
                               <div class="col-3">
                                   <strong> <i class="fas fa-shopping-cart"></i> Cart Sub Total</strong>
                                   <p class="text-muted">
                                       {{number_format($order->order_total, 2)}} VND
                                   </p>
                               </div>
                               <div class="col-3">
                                   <strong><i class="fas fa-money-bill-alt"></i> Tax(10%)</strong>

                                   <p class="text-muted">{{number_format($order->order_total/10, 2)}} VND</p>
                               </div>
                               <div class="col-3">
                                   <strong><i class="fas fa-truck-moving"></i> Shipping Cost</strong>

                                   <p class="text-muted">
                                       Free
                                   </p>
                               </div>
                               <div class="col-3">
                                   <strong><i class="fas fa-money-bill-alt"></i> Total</strong>

                                   <p class="text-muted">
                                       {{number_format($order->order_total + $order->order_total/10, 2)}} VND
                                   </p>
                               </div>
                           </div>

                            @if (isset($order->coupon_code_id))
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <strong><i class="fas fa-window-restore"></i> Coupon Type</strong>

                                        <p class="text-muted">  {{$order->couponCode->name. '-' . $order->couponCode->couponType->name}}</p>
                                    </div>

                                    @if($order->couponCode->coupon_type == 2)
                                        <div class="col-3">
                                            <strong>Coupon value</strong>
                                            <p class="text-muted">   Giảm {{$order->couponCode->code_value}}%</p>
                                        </div>
                                    @endif

                                    <div class="col-3">
                                        <strong><i class="fas fa-money-bill-alt"></i> Số tiền được giảm</strong>
                                        <p class="text-muted">
                                            @if($order->couponCode->coupon_type == 1)
                                                Giảm {{number_format($order->couponCode->code_value, 2)}} VND
                                            @else
                                                Giảm {{number_format( (($order->order_total + $order->order_total/10)/ 100)* $order->couponCode->code_value, 2) }} VND
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-3">
                                        <strong><i class="fas fa-sort-amount-down"></i> Số tiền sau khi giảm</strong>
                                        <p class="text-muted">
                                            @if($order->couponCode->coupon_type == 1)
                                                {{number_format($order->order_total + $order->order_total/10 - $order->couponCode->code_value, 2)}} VND
                                            @else
                                                {{number_format($order->order_total + $order->order_total/10 - (($order->order_total + $order->order_total/10)/ 100)* $order->couponCode->code_value, 2)  }} VND
                                            @endif
                                        </p>
                                    </div>


                                </div>
                            @endif


                        </div>
                        <!-- /.card-body -->
                    </div>
            </div>
            <!-- /.content -->
        </div>
    </div>
@endsection
@section('style')
    <style>
        #example1_wrapper > .row
        {
            margin: 0;
        }
        #example1_filter label
        {
            float: right;
            width: 70%;
        }

    </style>
@stop
@section('script')
    <!-- DataTables -->
    <script src="backend/adminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="backend/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="backend/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
