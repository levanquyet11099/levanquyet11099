@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn vị</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.unit') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th widtd="2%" class="text-center">STT</th>
                                <th>Mã đơn vị</th>
                                <th>Tên đơn vị</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                            @if(!$units->isEmpty())
                                @foreach($units as $key => $unit)
                                    <tr>
                                        <td widtd="2%" class="text-center">{{$key + 1}}</td>
                                        <td>{{ $unit->u_code }}</td>
                                        <td>{{ $unit->u_name }}</td>
                                        <td>{{ $unit->created_at }}</td>
                                        <td>{{ $unit->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('get.update.unit',$unit->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.unit',$unit->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-footer text-right">
                    {{ $units->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection