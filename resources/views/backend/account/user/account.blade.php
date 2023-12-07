@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin tài khoản</h3>
                    </div>
                    <!-- /.box-header -->

                    <form method="post" action="{{route('update.account', \Auth::user()->id)}}">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Họ và tên lót <sup class="title-sup">(*)</sup></label>
                                <input type="text" name="full_name" class="form-control" value="{{old('full_name', isset($user->full_name) ? $user->full_name : '')}}" id="exampleInputEmail1" placeholder="Nguyễn Văn">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('full_name') }}</p></span>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email <sup class="title-sup">(*)</sup></label>
                                <input type="email" name="email" class="form-control" value="{{old('email', isset($user->email) ? $user->email : '')}}" id="exampleInputEmail1" placeholder="mail@ntt.edu.vn">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Số điện thoại<sup class="title-sup">(*)</sup></label>
                                <input type="text" name="phone" class="form-control" value="{{old('phone', isset($user->phone) ? $user->phone : '')}}" id="exampleInputEmail1" placeholder="Điện thoại di động">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>

                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection