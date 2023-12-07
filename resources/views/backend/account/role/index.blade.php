@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách vai trò người dùng</h3>
                    <div class="box-tools">
                        <a href="{{ route('get.create.role') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th width="2%" class="text-center">STT</th>
                            <th>Tên vai trò</th>
                            <th>Danh sách quyền</th>
                            <th>Mô tả</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                        @if($roles)
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$role->display_name}}</td>
                                    <td style="max-width: 250px">
                                        @if(!empty($role->permissionRole))
                                            @foreach($role->permissionRole as $permission)
                                            <span class="label label-success" style="line-height: 2;">{{$permission->display_name}}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td style="max-width: 200px">{{$role->description}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('get.update.role',$role->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        {{--<a href="{{ route('get.delete.role',$role->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>--}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $roles->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>


@endsection

@section('script')
@endsection