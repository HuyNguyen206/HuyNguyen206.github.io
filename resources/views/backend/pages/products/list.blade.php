<?php
$i = 1;
?>

@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Product','action'=>'Danh sách product'])
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
                    @can('create', App\Product::class)
                        <div class="col-12"><a href="admin/product/add" class="btn btn-md btn-success float-right"> Thêm
                                product</a></div>
                    @endcan
                    <div class="col-12 mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Hình</th>
                                <th>Người tạo</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>

                                    <td>
                                        {{$p->name}}
                                    </td>

                                    <td>
                                        {{ number_format($p->price, 2) }}
                                    </td>

                                    <td>
                                        @if(!empty($p->feature_image_path))
                                            <img class="image-product" src="{{$p->feature_image_path}}">
                                        @endif
                                    </td>

                                    <td>
                                        {{$p->user->name}}
                                    </td>

                                    <td>
                                        {{optional($p->category)->name}}
                                    </td>

                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', $p)
                                                <a href="admin/product/edit/{{$p->id}}" class="btn btn-success"> Sửa</a>
                                            @endcan
                                            @can('delete', App\Product::class)
                                                <a data-url-delete="{{url('admin/product/delete/'.$p->id)}}" href="admin/product/delete/{{$p->id}}" class="btn btn-danger delete">
                                                    Xóa</a>
                                            @endcan
                                        </div>
                                    </td>

                                    <td>
                                        {{$p->created_at}}
                                    </td>

                                    <td>
                                        {{$p->updated_at}}
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
