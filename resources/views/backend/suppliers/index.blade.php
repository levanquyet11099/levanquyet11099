@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách nhà cung cấp</h3>

                    <div class="box-tools">
                        <a href="{!! route('get.create.supplier') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="s_code" placeholder="Tìm mã nhà cung cấp ..." value="{{ Request::get('s_code') }}">
                            <input type="text" class="form-control" name="s_name" placeholder="Tìm tên nhà cung cấp ..." value="{{ Request::get('s_name') }}">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                    {{--<div class="pull-right"> Hiển thị: 1 to 30 / Tổng 187653 record </div>--}}
                    <div class="clearfix"></div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th width="2%" class="text-center">STT</th>
                                <th>Mã nhà cung cấp</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fax</th>
                                <th>Website</th>
                                <th>Thao tác</th>
                            </tr>
                            @if(!$suppliers->isEmpty())
                                @foreach($suppliers as $key => $supplier)
                                    <tr>
                                        <td widtd="2%" class="text-center">{{$key + 1}}</td>
                                        <td>{{ $supplier->s_code }}</td>
                                        <td>{{ $supplier->s_name }}</td>
                                        <td>{{ $supplier->s_email }}</td>
                                        <td>{{ $supplier->s_phone }}</td>
                                        <td>{{ $supplier->s_fax }}</td>
                                        <td><a href="{{ $supplier->s_website }}" target="_blank">{{ $supplier->s_website }}</a></td>
                                        <td>
                                            <a href="{{ route('get.update.supplier',$supplier->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.supplier',$supplier->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-footer text-right">
                    {{ $suppliers->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection