@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách thành viên</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.user') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="account" placeholder="Tên tài khoản" value="{{ Request::get('account') }}">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Request::get('email') }}">
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ Request::get('phone') }}">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th width="2%" class="text-center">STT</th>
                                <th>Tên tài khoản</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @if($users)
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td width="2%" class="text-center">{{$key + 1}}</td>
                                        <td>{{$user->account}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            @if($user->userRole != null)
                                                @foreach($user->userRole as $role)
                                                    <span class="label label-success">{{$role->display_name}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status)
                                                <span class="label label-success">Hoạt động</span>
                                            @else
                                                <span class="label label-default">Ngừng Hoạt Động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('get.update.user',$user->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.user',$user->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $users->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
@section('script')
@endsection