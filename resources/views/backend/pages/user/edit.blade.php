@extends('backend.layout.index')
@section('style')
    <link href="backend/vendors/select2/select2.min.css" rel="stylesheet"/>
    <style>
        input.check-pass {
            display: block;
            width: 3%;
        }
    </style>
    {{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
    {{--    <link type="text/css" rel="stylesheet" href="backend/assets/image-uploader/dist/image-uploader.min.css">--}}
@endsection
<?php
//$roleUser = [];
//if (!$errors->any()) {
//    foreach ($user->roles as $role) {
//        $roleUser[] = $role->id;
//    }
//}
//?>

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('backend.pages.content-header', ['type'=>'User','action'=>'Edit user'])
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
                            <div class="alert @if(session('isSuccess')) alert-success @else alert-danger @endif alert-dismissible fade show"
                                role="alert">
                                {{session('message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                        <form role="form" action="admin/user/edit/{{$user->id}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name"
                                               value="@if($errors->any()){{ old('name') }}@else{{$user->name}}@endif"
                                               type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter ...">
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
                                        <label>Email</label>
                                        <input name="email"
                                               value="{{$user->email}}"
                                               type="text"
                                               class="form-control"
                                               placeholder="Enter ..." readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Change Password</label>
                                        <input type="checkbox" name="change-pass"
                                               @if(!empty(old('change-pass'))) checked
                                               @endif class="form-control check-pass">
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password"
                                               type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Enter ..." disabled>
                                        @error('password')
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
                                        <label>Password repeat</label>
                                        <input name="password-repeat"
                                               type="password"
                                               class="form-control @error('password-repeat') is-invalid @enderror"
                                               placeholder="Enter ..." disabled>
                                        @error('password-repeat')
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
                                        <label>Role</label>

                                        <select class="form-control role-select @error('roles') is-invalid @enderror"
                                                name="roles[]" multiple="multiple">
                                            @foreach ($roles as $r)
                                                <option
                                                    @if (($errors->any() && is_array(old('roles')) && in_array($r->id, old('roles'))) || $user->roles->contains('id', $r->id))  selected
                                                    @endif value="{{$r->id}}">{{$r->name}}</option>
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
    <script>
        $(function () {

            $('.role-select').select2({
                placeholder: "Select Role"
            })

            function checkPass() {
                if (($(".check-pass")).is(":checked")) {
                    $('input[name*=password]').attr('disabled', false)
                } else {
                    $('input[name*=password]').attr('disabled', '')
                }
            }

            checkPass()
            $('.check-pass').click(function () {
                checkPass()
            })
        })

    </script>
    {{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    {{--    <script src="backend/vendors/tinyMCE/tinymce.min.js"></script>--}}
    {{--    <script src="backend/sliders/edit.js"></script>--}}
    {{--    <script type="text/javascript" src="backend/assets/image-uploader/dist/image-uploader.min.js"></script>--}}

@endsection
