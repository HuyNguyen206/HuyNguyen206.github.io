@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Order','action'=>'Danh sách Order'])
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Khách hàng</th>
                                <th>Phương thức thanh toắn</th>
                                <th>Đơn vị vận chuyển</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Tổng tiền(chưa bao gồm thuế, mã giảm giá...)</th>
                                <th>Ghi chú</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $o)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$o->customer->user->name}}
                                    </td>
                                    <td>
                                        {{$o->paymentMethod->name}}
                                    </td>
                                    <td>
                                        {{isset($o->transportCompany) ? $o->transportCompany->name : ''}}
                                    </td>
                                    <td>
                                        {{$o->orderStatus->name}}
                                    </td>
                                    <td>
                                        {{number_format($o->order_total, 2)}}
                                    </td>
                                    <td>
                                        {{$o->order_note}}
                                    </td>
                                    <td>
                                        {{$o->created_at}}
                                    </td>
                                    <td>
                                        {{$o->updated_at}}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
{{--                                            @can('update', App\Menu::class)--}}
                                                <a href="admin/order/order-detail/{{$o->id}}" class="btn btn-success"> View detail</a>
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
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
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
