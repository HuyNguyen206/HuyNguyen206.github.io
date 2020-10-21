@extends('backend.layout.index')
@section('style')
    <style>
        input[type=checkbox]{
            width: 20px;
            height: 20px;
        }

    </style>
    @endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Permission','action'=>'Bootstrap permission'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert @if(session('isSuccess')) ? alert-success @else alert-danger @endif">
                                {{session('message')}}
                            </div>
                        </div>
                    </div>
                @endif
                    @if (count($errors) > 0)
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{$error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                <div class="row">
                    <div class="col-12">
                        <form role="form" action="admin/permission/bootstrap" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Chọn tên module cha</label>
                                        <select name="parent_module" class="form-control">
                                            @foreach (config('permission.module_permission') as $key => $module)
                                                <option value="{{$key}}"> {{$module}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12">
                                    <label>Danh sách permission</label>
                                </div>
                                <div class="col-12">
                                    <label for="">Check/Uncheck All</label>
                                    <input type="checkbox" class="check-all">
                                </div>
                                @foreach (config('permission.child_permission') as $key => $permission)
                                    <div class="col">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>{{$permission}}</label>
                                            <input name="permission[]" type="checkbox" class="form-control" value="{{$key}}" placeholder="Enter ...">

                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $(function(){
            $('.check-all').change(function(){
                console.log(123)
                $('input[name="permission[]"]').prop('checked', $(this).prop('checked'))
            })
        })
    </script>
    @endsection
