@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn hàng đã xuất</h3>
                    <div class="box-tools">
                        <a href="{!! route('get.export.create.product') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>  Tạo mới đơn hàng</a>
                    </div>
                    <div class="box-header">
                        <div class="pull-left">
                            <form action="" class="form-inline">
                                <input type="text" class="form-control" name="w_code" placeholder="Tìm mã đơn hàng ..." value="{{ Request::get('w_code') }}">
                                <input type="text" class="form-control" name="w_name" placeholder="Tìm nội dung nhập hàng ..." value="{{ Request::get('w_name') }}">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th widtd="2%" class="text-center">STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Nội dung xuất hàng</th>
                                <th>Người xuất</th>
                                <th>Ghi chú</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                            @if (!$warehousings->isEmpty())
                                @foreach($warehousings as $key => $warehousing)
                                    <tr class="has-error">
                                        <td widtd="2%" class="text-center">{{ $key +  1 }}</td>
                                        <td>{{ $warehousing->w_code }}</td>
                                        <td>
                                            <p class="text-type-doccument" data-toggle="tooltip" data-placement="top" title="{{ $warehousing->w_name }}" >
                                                <span class="content-space" title="{{ $warehousing->w_name }}">
                                                    {{ $warehousing->w_name }}
                                                </span>
                                            </p>
                                        </td>
                                        <td>{{ $warehousing->user->full_name }}</td>
                                        <td>
                                            <p class="text-space-description" data-toggle="tooltip" data-placement="top" title="{{ $warehousing->w_note }}" >
                                                <span class="content-space" title="{{ $warehousing->w_note }}">
                                                    {{ $warehousing->w_note }}
                                                </span>
                                            </p>
                                        </td>
                                        <td>{{ $warehousing->created_at }}</td>
                                        <td>
                                            <a href="{{ route('export.goods_receipt.preview', $warehousing->id) }}" class="btn btn-xs btn-info btn_preview_warehousing"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('get.export.edit.product', $warehousing->id) }}" class="btn btn-xs btn-info margin-action" style="margin: 5px 0px;"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('delete.export.product', $warehousing->id) }}" class="btn btn-xs btn-info confirm__btn margin-action"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-footer text-right">
                    {{ $warehousings->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>

    <div class="modal warehousing_preview fade" id="modal-default">
        <div class="modal-dialog modal-lg" style="width: 710px !important;">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none; padding-bottom: 0px;">
                    <p style="float: left"> CTY TNHH 1 Thành Viên PMKN</p>
                </div>
                <div class="modal-header" style="padding-top: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" style="margin-left: 32%; text-transform: uppercase; font-weight: bold;">Chi tiết phiếu xuất hàng</h4>
                </div>
                <div class="modal-body" id="warehousing_preview">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn bg-green pull-right mg-r-5" data-dismiss="modal" onclick="js:window.print()"><i class="fa fa-fw fa-print"></i> Print</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.mod -->
    </div>
@endsection