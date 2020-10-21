<?php
$i = 1;
?>

@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Setting','action'=>'Danh sách Setting'])
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
                    @can('create', App\Setting::class)
                        <div class="row w-100">
                            <div class="col-12">
                                <div class="dropdown float-right">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Add Setting
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="admin/setting/add?type=Text">Text</a>
                                        <a class="dropdown-item" href="admin/setting/add?type=TextArea">TextArea</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan

                    <div class="col-12 mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Config key</th>
                                <th>Config value</th>
                                <th>Action</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($settings as $s)
                                <tr>
                                    <td>
                                        {{$i++ }}
                                    </td>

                                    <td>
                                        {{$s->config_key}}
                                    </td>

                                    <td>
                                        {{ $s->config_value }}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            @can('update', App\Setting::class)
                                                <a href="admin/setting/edit/{{$s->id}}?type={{$s->type}}"
                                                   class="btn btn-success"> Sửa</a>
                                            @endcan
                                            @can('delete', App\Setting::class)
                                                <a data-url-delete="{{url('admin/setting/delete/'.$s->id)}}"
                                                   href="admin/setting/delete/{{$s->id}}" class="btn btn-danger delete">
                                                    Xóa</a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>
                                        {{$s->created_at}}
                                    </td>

                                    <td>
                                        {{$s->updated_at}}
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
