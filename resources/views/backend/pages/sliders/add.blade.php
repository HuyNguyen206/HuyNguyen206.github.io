@extends('backend.layout.index')
@section('style')
{{--    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
{{--    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">--}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Slide','action'=>'Thêm sản phẩm'])
    <!-- /.content-header -->

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
                        <form role="form" action="admin/slider/add" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên slide</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror " placeholder="Enter ..." value="{{old('name')}}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea name="description" class="form-control  @error('description') is-invalid @enderror" rows="6"
                                                      placeholder="Enter ...">{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"  class="custom-file-input feature-image @error('feature_image') is-invalid @enderror" name="feature_image"
                                                   id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose feature
                                                image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                    @error('feature_image')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <img src="" alt="" class="new-image" style="width: 300px">
                                </div>
                            </div>

                            <div class="row mt-3">
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
@section('script')
{{--    <script src="backend/vendors/select2/select2.min.js"></script>--}}
{{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
{{--    <script src="backend/vendors/tinyMCE/tinymce.min.js"></script>--}}
    <script src="backend/sliders/add.js"></script>
{{--    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>--}}

@endsection
