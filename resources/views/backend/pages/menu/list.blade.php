<?php
$i = 1;
?>
@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Menu','action'=>'Danh sách menu'])
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
                    @can('create', App\Menu::class)
                        <div class="col-12"><a href="admin/menu/add" class="btn btn-md btn-success float-right"> Thêm
                                Menu</a></div>
                    @endcan
                    <div class="col-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Menu cha</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($menus as $m)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>
                                    <td>
                                        {{$m->name}}
                                    </td>
                                    <td>
                                        {{$m->parent_id != 0 ? $m->find($m->parent_id)->name : ""}}
                                    </td>
                                    <td>
                                        {{$m->slug}}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\Menu::class)
                                                <a href="admin/menu/edit/{{$m->id}}" class="btn btn-success"> Sửa</a>
                                            @endcan
                                            @can('delete', App\Menu::class)
                                                <a href="admin/menu/delete/{{$m->id}}" class="btn btn-danger"> Xóa</a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>
                                        {{$m->created_at}}
                                    </td>
                                    <td>
                                        {{$m->updated_at}}
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
