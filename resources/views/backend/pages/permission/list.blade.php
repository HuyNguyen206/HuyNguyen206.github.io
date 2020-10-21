<?php
$i = 1;
?>
@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Permission','action'=>'Danh sách Permission'])
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
                        <div class="btn-group float-right">
                            @can('bootstrap', App\Permission::class)
                                <a href="admin/permission/bootstrap" class="btn btn-md btn-success"> Bootstrap
                                    Permission</a>
                            @endcan
                            @can('create', App\Permission::class)
                                <a href="admin/permission/add" class="btn btn-md btn-secondary"> Thêm
                                    Permission</a>
                            @endcan
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Permission Module</th>
                                <th>Key Code</th>
                                <th>Hành động</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $p)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>
                                    <td>
                                        {{$p->name}}
                                    </td>
                                    <td>
                                        {{$p->display_name}}
                                    </td>
                                    <td>
                                        {{$p->parent_id != 0 ? $p->parentPermisison->name : ""}}
                                    </td>
                                    <td>
                                        {{$p->key_code}}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\Permission::class)
                                                <a href="admin/permission/edit/{{$p->id}}" class="btn btn-success">
                                                    Sửa</a>
                                            @endcan
                                            @can('delete', App\Permission::class)
                                                <a href="admin/permission/delete/{{$p->id}}"
                                                   data-url-delete="{{url('admin/permission/delete/'.$p->id)}}"
                                                   class="btn btn-danger delete"> Xóa</a>
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
