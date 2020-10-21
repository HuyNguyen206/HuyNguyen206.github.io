@extends('backend.layout.index')
@section('style')
        <link href="backend/vendors/select2/select2.min.css" rel="stylesheet" />
    {{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
    {{--    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">--}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'User','action'=>'Thêm user'])
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
                        <form role="form" action="admin/user/add" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror "
                                               placeholder="Enter ..." value="{{old('name')}}">
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
                                            <label>Email</label>
                                                <input name="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror "
                                                       placeholder="Enter ..." value="{{old('email')}}">
                                                @error('email')
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
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input name="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror "
                                                   placeholder="Enter ...">
                                            @error('password')
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
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Password Repeat</label>
                                            <input name="password-repeat" type="password"
                                                   class="form-control @error('password-repeat') is-invalid @enderror "
                                                   placeholder="Enter ...">
                                            @error('password-repeat')
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
                                        <div class="form-group">
                                            <label>Role</label>

                                            <select class="form-control role-select @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple">
                                                @foreach ($roles as $r)
                                                    <option @if ($errors->any() && is_array(old('roles')) && in_array($r->id, old('roles'))) selected @endif value="{{$r->id}}">{{$r->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>

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
        <script src="backend/vendors/select2/select2.min.js"></script>
        <script>
            $(function(){

                $('.role-select').select2({
                    placeholder:"Select Role"
                })
            })

        </script>
    {{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    {{--    <script src="backend/vendors/tinyMCE/tinymce.min.js"></script>--}}
    {{--    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>--}}

@endsection
