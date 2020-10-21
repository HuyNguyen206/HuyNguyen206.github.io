<?php
$i = 1;
?>
@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Category','action'=>'Danh mục'])
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
                    @can('create', App\Category::class)
                    <div class="col-12"><a href="admin/category/add" class="btn btn-md btn-success float-right"> Thêm
                            danh mục</a></div>
                    @endcan
                    <div class="col-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Danh mục cha</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $c)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>
                                    <td>
                                        {{$c->name}}
                                    </td>
                                    <td>
                                        {{$c->parent_id != 0 ? $c->find($c->parent_id)->name : ""}}
                                    </td>
                                    <td>
                                        {{$c->slug}}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\Category::class)
                                                <a href="admin/category/edit/{{$c->id}}" class="btn btn-success">
                                                    Sửa</a>
                                            @endcan
                                            @can('delete', App\Category::class)
                                                <a href="admin/category/delete/{{$c->id}}" class="btn btn-danger">
                                                    Xóa</a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>
                                        {{$c->created_at}}
                                    </td>
                                    <td>
                                        {{$c->updated_at}}
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
