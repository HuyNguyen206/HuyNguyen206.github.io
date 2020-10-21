
@extends('backend.layout.index')
@section('style')
{{--    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
{{--    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">--}}
<link rel="stylesheet" href="backend/role/edit.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Role','action'=>'Edit Role'])
    <!-- /.content-header -->
<?php
//dump($errors->any());
//dump($product);
//die;
?>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert @if(session('isSuccess')) alert-success @else alert-danger @endif">
                                {{session('message')}}
                            </div>
                        </div>
                    </div>
                @endif
{{--                @if (count($errors) > 0)--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    {{$error}}<br>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="row">
                    <div class="col-12">
                        <form role="form" action="admin/role/edit/{{$role->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên Role</label>
                                        <input name="name" value="@if($errors->any()){{ old('name') }}@else{{$role->name}}@endif" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter ...">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mô tả Role</label>
                                        <input name="display_name" value="@if($errors->any()){{ old('display_name') }}@else{{$role->display_name}}@endif" type="text" class="form-control @error('display_name') is-invalid @enderror" placeholder="Enter ...">
                                        @error('display_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="checkbox" class="select-all-admin">
                                    <label> Check all</label>
                                </div>
                            </div>
                            @foreach ($parentPermissions as $parent)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border-primary mb-3">
                                            <div class="card-header head-title">
                                                <input type="checkbox" class="select-all">
                                                <label style="text-transform: capitalize">Module {{$parent->name}}</label>
                                            </div>
                                            <div class="row">
                                                @foreach ($parent->childPermission as $child)
                                                    <div class="card-body text-primary col-3">
                                                        <input type="checkbox" name="permission[]" class="action" @if ($role->permissions->contains('id', $child->id))  checked @endif value="{{$child->id}}">
                                                        <label> {{$child->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @error('permission')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror


                            <div class="row mt-3">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-success" value="Update">
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
{{--    <script src="backend/vendors/select2/select2.min.js"></script>--}}
{{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    {{--    <script src="backend/vendors/tinyMCE/tinymce.min.js"></script>--}}
    <script src="backend/role/edit.js"></script>
{{--    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>--}}

@endsection
