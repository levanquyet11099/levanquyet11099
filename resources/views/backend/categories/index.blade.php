@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách loại hàng</h3>

                    <div class="box-tools">
                        <a href="{!! route('get.create.category') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="c_code" placeholder="Tìm mã loại hàng ..." value="{{ Request::get('c_code') }}">
                            <input type="text" class="form-control" name="c_name" placeholder="Tìm tên loại hàng ..." value="{{ Request::get('c_name') }}">
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
                                <th widtd="2%" class="text-center">STT</th>
                                <th>Mã loại mặt hàng</th>
                                <th>Loại mặt hàng</th>
                                <th>Nhà cung cấp</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                            @if(!$categories->isEmpty())
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td widtd="2%" class="text-center">{{$key + 1}}</td>
                                        <td>{{ $category->c_code }}</td>
                                        <td>{{ $category->c_name }}</td>
                                        <td>{{ $category->supplier !== null ? $category->supplier->s_name : '' }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('get.update.category',$category->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.category',$category->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    {{ $categories->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection