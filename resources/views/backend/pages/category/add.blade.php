@extends('backend.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Category','action'=>'Thêm danh mục'])
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
                        <form role="form" action="admin/category/add" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input name="name" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>

                            </div>
                            <div class="row">


                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Chọn danh mục cha</label>
                                        <select name="parent_name_id" class="form-control">
                                            <option value="0">--Danh mục cha--</option>
                                           {!!$htmlSelectData!!}
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-success" value="Add">
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
