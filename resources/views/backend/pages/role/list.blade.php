<?php
$i = 1;
?>

@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Roles','action'=>'Danh sách role'])
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
                    @can('create', App\Role::class)
                        <div class="col-12"><a href="admin/role/add" class="btn btn-md btn-success float-right"> Thêm
                                role</a></div>
                    @endcan
                    <div class="col-12 mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Action</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $r)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>

                                    <td>
                                        {{$r->name}}
                                    </td>

                                    <td>
                                        {{ $r->display_name }}
                                    </td>


                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\Role::class)
                                                <a href="admin/role/edit/{{$r->id}}" class="btn btn-success"> Sửa</a>
                                            @endcan
                                            @can('delete', App\Role::class)
                                                <a data-url-delete="{{url('admin/role/delete/'.$r->id)}}"
                                                   href="admin/role/delete/{{$r->id}}" class="btn btn-danger delete">
                                                    Xóa</a>
                                            @endcan
                                        </div>
                                    </td>

                                    <td>
                                        {{$r->created_at}}
                                    </td>

                                    <td>
                                        {{$r->updated_at}}
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
