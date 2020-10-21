@extends('backend.layout.index')
@section('style')
    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'Coupon','action'=>'Sửa coupon'])
    <!-- /.content-header -->
    {{--        {{dd($errors->all())}}--}}
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
                        <form role="form" action="admin/coupon/edit/{{$coupon->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tên coupon</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('name')}}@else{{$coupon->name}}@endif">
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
                                        <label>Số lượng</label>
                                        <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('quantity')}}@else{{$coupon->quantity}}@endif">
                                        @error('quantity')
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
                                        <label>Số lượng đã dùng</label>
                                        <input type="number" class="form-control" readonly  value="{{$coupon->quantity_used}}">
                                    </div>
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
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="description" class="form-control content-product @error('description') is-invalid @enderror" rows="10"
                                                  placeholder="Enter ...">@if($errors->any()){{old('description')}}@else{{$coupon->description}}@endif</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Chọn hình thức giảm giá</label>
                                        <select name="coupon_type" class="form-control list-categories @error('coupon_type') is-invalid @enderror">
                                            @foreach ($couponTypes as $ct)
                                                <option @if(($errors->any() && $ct->id == old('coupon_type')) || $ct->id == $coupon->coupon_type) selected @endif value="{{$ct->id}}"> {{$ct->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('coupon_type')
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
                                        <label>Code</label>
                                        <input name="code" type="text" class="form-control @error('code') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('code')}}@else{{$coupon->code}}@endif">
                                        @error('code')
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
                                        <label>Code value</label>
                                        <input name="code_value" type="text" class="form-control @error('code_value') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('code_value')}}@else{{$coupon->code_value}}@endif">
                                        @error('code')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Ngày áp dụng</label>
                                        <input name="start_date" type="date" class="form-control @error('code') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('start_date')}}@else{{$coupon->start_date}}@endif">
                                        @error('start_date')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Ngày kết thúc</label>
                                        <input name="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror " placeholder="Enter ..." value="@if($errors->any()){{old('end_date')}}@else{{$coupon->end_date}}@endif">
                                        @error('end_date')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
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
@endsection
