
@extends('backend.layout.index')
@section('style')
{{--    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
{{--    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">--}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Slider','action'=>'Edit slide'])
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
                        <form role="form" action="admin/slider/edit/{{$slider->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên slide</label>
                                        <input name="name" value="@if($errors->any()){{ old('name') }}@else{{$slider->name}}@endif" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter ...">
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
                                        <label>Mô tả</label>
                                        <textarea name="description" class="form-control content-product @error('description') is-invalid @enderror" rows="10"
                                                  placeholder="Enter ...">@if($errors->any()){{old('description')}}@else{{ $slider->description }}@endif</textarea>
                                        @error('description')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"  class="custom-file-input feature-image" name="feature_image"
                                                   id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose feature
                                                image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <img src="{{$slider->image_path}}" alt="" class="new-image" style="width: 300px">
                                </div>
                            </div>


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
    <script src="backend/sliders/edit.js"></script>
{{--    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>--}}

@endsection
