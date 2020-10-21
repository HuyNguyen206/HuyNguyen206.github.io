<?php
$i = 1;
?>

@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'User','action'=>'Danh sách User'])
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
                    @can('create', App\User::class)
                        <div class="col-12"><a href="admin/user/add" class="btn btn-md btn-success float-right"> Thêm
                                user</a></div>
                    @endcan
                    <div class="col-12 mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>

                                    <td>
                                        {{$u->name}}
                                    </td>

                                    <td>
                                        {{ $u->email }}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\User::class)
                                                <a href="admin/user/edit/{{$u->id}}?type={{$u->type}}"
                                                   class="btn btn-success"> Sửa</a>
                                            @endcan
                                            @can('delete', App\User::class)
                                                <a data-url-delete="{{url('admin/user/delete/'.$u->id)}}"
                                                   href="admin/user/delete/{{$u->id}}" class="btn btn-danger delete">
                                                    Xóa</a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>
                                        {{$u->created_at}}
                                    </td>

                                    <td>
                                        {{$u->updated_at}}
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
