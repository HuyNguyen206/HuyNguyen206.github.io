@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Coupon','action'=>'Danh sách coupon'])
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
{{--                    @can('create', App\Product::class)--}}
                        <div class="col-12"><a href="admin/coupon/add" class="btn btn-md btn-success float-right"> Thêm
                                coupon</a></div>
{{--                    @endcan--}}
                    <div class="col-12 mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Đã dùng</th>
                                <th>Mô tả</th>
                                <th>Hình thức giảm giá</th>
                                <th>Code</th>
                                <th>Giá trị</th>
                                <th>Ngày áp dụng</th>
                                <th>Ngày kết thúc</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($coupons as $c)
                                <tr>
                                    <td>
                                        {{$loop->iteration }}
                                    </td>

                                    <td>
                                        {{$c->name}}
                                    </td>

                                    <td>
                                       {{$c->quantity}}
                                    </td>
                                    <td>
                                        {{$c->quantity_used}}
                                    </td>
                                    <td>
                                      {{$c->description}}
                                    </td>

                                    <td>
                                   {{$c->couponType->name}}
                                    </td>

                                    <td>
                                        {{$c->code}}
                                    </td>

                                    <td>
                                        {{$c->code_value}}
                                    </td>

                                    <td>
                                        {{$c->start_date}}
                                    </td>

                                    <td>
                                        {{$c->end_date}}
                                    </td>

                                    <td>
                                        <div class="btn btn-group">
{{--                                            @can('update', $p)--}}
                                                <a href="admin/coupon/edit/{{$c->id}}" class="btn btn-success"> Sửa</a>
{{--                                            @endcan--}}
{{--                                            @can('delete', App\Product::class)--}}
                                                <a data-url-delete="{{url('admin/coupon/delete/'.$c->id)}}" href="admin/coupon/delete/{{$c->id}}" class="btn btn-danger delete">
                                                    Xóa</a>
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
    <script src="backend/vendors/sweetAlert2/sweetalert2@9.js"></script>
    <script src="backend/common/main.js"></script>
@endsection
