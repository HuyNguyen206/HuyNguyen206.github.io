
@extends('backend.layout.index')
@section('style')
    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Product','action'=>'Edit sản phẩm'])
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
                        <form role="form" action="admin/product/edit/{{$product->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input name="name" value="@if($errors->any()){{ old('name') }}@else{{$product->name}}@endif" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter ...">
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
                                        <label>Giá sản phẩm</label>
                                        <input name="price" type="text" value="@if($errors->any()){{ old('price') }}@else{{$product->price}}@endif" class="currency form-control @error('price') is-invalid @enderror" placeholder="Enter ...">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
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
                                    <img src="@if (isset($product->feature_image_path)) {{$product->feature_image_path}} @else storage/products/no-image.png @endif" alt="" class="new-image" style="width: 300px">
                                </div>
                            </div>
                            {{--                            <div class="row mt-2">--}}
                            {{--                                <div class="col-12">--}}
                            {{--                                    <div class="input-group">--}}
                            {{--                                        <div class="custom-file">--}}
                            {{--                                            <input type="file"  class="custom-file-input list-image-detail" name="image_detail[]" multiple>--}}
                            {{--                                            <label class="custom-file-label" for="exampleInputFile">Choose detail--}}
                            {{--                                                image</label>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="input-group-append">--}}
                            {{--                                            <span class="input-group-text" id="">Upload</span>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-12">--}}
                            {{--                                   <div class="gallery-product-image"></div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label>Choose image details</label>
                                    <div class="input-images"></div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea name="contents" class="form-control content-product @error('contents') is-invalid @enderror" rows="10"
                                                  placeholder="Enter ...">
                                            {!! $product->content !!}
                                        </textarea>
                                        @error('contents')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Chọn danh mục</label>
                                        <select name="category_id" class="form-control list-categories">

                                            {!! $htmlSelectData !!}


                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Gắn tag</label>
                                        <select class="form-control list-tag" name="tags[]" multiple="multiple">
                                            @foreach ($product->tags as $t)
                                                <option selected value="{{$t->name}}">{{$t->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input name="meta_keywords"  value="@if($errors->any()){{old('meta_keywords')}}@else{{$product->meta_keywords}}@endif" type="text" class="form-control @error('meta_keywords') is-invalid @enderror " placeholder="Enter ...">
                                        @error('meta_keywords')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Meta desc</label>
                                        <textarea name="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror " id="" cols="30" rows="10">@if($errors->any()){{old('meta_desc')}}@else{{$product->meta_desc}}@endif</textarea>
                                        @error('meta_desc')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
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
    <script src="backend/vendors/select2/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {{--    <script src="backend/vendors/tinyMCE/tinymce.min.js"></script>--}}
    <script src="backend/products/edit.js"></script>
    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>
<script>
    let preloaded = [
        @foreach($product->productImages as $im)
            {id:{{$im->id}}, src:"{{$im->image_path}}"},
        @endforeach
    ];

    $('.input-images').imageUploader(
        {
            preloaded: preloaded,
            imagesInputName: 'image_detail',
        }
    );
</script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script>
        $(function(){
            // The options are...optional :)
            const autoNumericOptionsEuro = {
                digitGroupSeparator        : ',',
                decimalCharacter           : '.',
                // decimalCharacterAlternative: '.',
                currencySymbol             : 'đ ',
                unformatOnSubmit:           true
                // currencySymbolPlacement    : AutoNumeric.options.currencySymbolPlacement.suffix,
                // roundingMethod             : AutoNumeric.options.roundingMethod.halfUpSymmetric,
            };

// Initialization
            new AutoNumeric('.currency', autoNumericOptionsEuro);
        })
    </script>
@endsection
