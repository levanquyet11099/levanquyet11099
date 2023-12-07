@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tạo mới dữ liệu xuất hàng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                     @include('backend.goods_receipt.form')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection