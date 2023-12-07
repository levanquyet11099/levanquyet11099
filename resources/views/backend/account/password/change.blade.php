@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Đổi mật khẩu</h3>
                    </div>
                    <!-- /.box-header -->
                    <form method="post" action="{{route('post.change.password')}}">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Mật khẩu cũ <sup class="title-sup">(*)</sup></label>
                                <input type="password" name="current_password" class="form-control" value="">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('current_password') }}</p></span>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Mật khẩu mới <sup class="title-sup">(*)</sup></label>
                                <input type="password" name="password" class="form-control" value="">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                            </div>

                            <div class="form-group {{ $errors->has('r_password') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Nhập lại mật khẩu  <sup class="title-sup">(*)</sup></label>
                                <input type="password" name="r_password" class="form-control" value="" >
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('r_password') }}</p></span>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
                            <a href="#" onclick="window.history.back()" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection