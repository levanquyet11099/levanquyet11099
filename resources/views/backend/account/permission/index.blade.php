@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách quyền</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.permission') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody><tr>
                            <th width="2%" class="text-center">STT</th>
                            <th>Tên quyền</th>
                            <th>Nhóm</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                        @if($permissions)
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    <td width="2%" class="text-center">{{$key + 1}}</td>
                                    <td>{{$permission->display_name}}</td>
                                    <td><span class="label label-success">{{$permission->groups->name}}</span></td>
                                    <td>{{$permission->description}}</td>
                                    <td>
                                        <a href="{{ route('get.update.permission',$permission->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.permission',$permission->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $permissions->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>


@endsection

@section('script')
@endsection